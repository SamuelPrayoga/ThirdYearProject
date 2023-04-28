<?php

namespace Database\Seeders;

use App\Models\Position;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(PositionSeeder::class);

        \App\Models\User::factory()->create([
            'nim' => '111111',
            'asrama' => '-',
            'prodi' => '-',
            'angkatan' => '-',
            'name' => 'Super Admin',
            'email' => 'SuperAdmin@gmail.com',
            'role_id' => Role::where('name', 'admin')->first('id'),
            'position_id' => Position::where('name', 'Keasramaan')->first('id'),
        ]);
        \App\Models\User::factory(1)->create([
            'role_id' => Role::where('name', 'keasramaan')->first('id'),
            'position_id' => Position::where('name', 'Keasramaan')->first('id'),
        ]);
        \App\Models\User::factory(10)->create([
            'role_id' => Role::where('name', 'user')->first('id'), // user === mahasiswa
            'position_id' => Position::select('id')->inRandomOrder()->first()->id
        ]);
    }
}
