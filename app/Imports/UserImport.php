<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Throwable;

class UserImport implements ToModel, SkipsOnError
{
    use Importable, SkipsErrors;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'nim' => $row[1],
            'name' => $row[2],
            'prodi' => $row[3],
            'angkatan' => $row[4],
            'asrama' => $row[5],
            'email' => $row[6],
            'phone' => $row[7],
            'position_id' => $row[8],
            'role_id' => $row[9],
            'password' =>Hash::make('password')

        ]);
    }

    public function onError(Throwable $e)
    {

    }
}
