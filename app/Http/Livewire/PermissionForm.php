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
        'permission.title' => 'required|string|min:6',
        'permission.description' => 'required|string|max:500',
        'permission.file' => 'required|file|mimes:jpeg,png,jpg,gif,svg,pdf|max:10048',  //1MB
    ];

    public function save()
    {
        $this->validate();

        Permission::create([
            "user_id" => auth()->user()->id,
            "attendance_id" => $this->attendanceId,
            "title" => $this->permission['title'],
            "description" => $this->permission['description'],
            "file" => $this->permission['file'],
            "permission_date" => now()->toDateString()
        ]);


        return redirect()->route('home.show', $this->attendanceId)->with('success', 'Permintaan izin sedang diproses. Silahkan tunggu konfirmasi dari keasramaan atau hubungi keasramaan');
    }

    public function render()
    {
        return view('livewire.permission-form');
    }
}
