<?php

namespace App\Http\Livewire;

use App\Models\Permission;
use Livewire\Component;
use Livewire\WithFileUploads;


class PermissionForm extends Component
{
    use WithFileUploads;

    public $permission;
    public $attendanceId;

    protected $rules = [
        'permission.title' => 'required|string|min:3',
        'permission.description' => 'required|string|max:500',
        'permission.file' => 'required|file|mimes:jpeg,png,jpg,gif,svg,pdf|max:10048',  //1MB
    ];

    public function save()
    {
        $this->validate();

        $file_path = $this->permission['file']->store('izin', 'public');

        Permission::create([
            "user_id" => auth()->user()->id,
            "attendance_id" => $this->attendanceId,
            "title" => $this->permission['title'],
            "description" => $this->permission['description'],
            "file" => $file_path,
            "permission_date" => now()->toDateString()
        ]);

        return redirect()->route('home.show', $this->attendanceId)->with('toast_success', 'Permintaan izin sedang diproses. Silahkan tunggu konfirmasi dari keasramaan atau hubungi keasramaan');
    }

    public function render()
    {
        return view('livewire.permission-form');
    }
}
