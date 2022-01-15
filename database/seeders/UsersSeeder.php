<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Kurikulum Supervisor',
            'nip' => '1101',
            'alamat' => 'Garut',
            'role' => 'kurikulum',
            'supervisor' => 1,
            'email' => 'kurikulumsupervisor@abc.com',
            'password' => Hash::make('1101'),
        ]);
        User::create([
            'name' => 'Kepsek',
            'nip' => '1102',
            'alamat' => 'Bogor',
            'role' => 'kepsek',
            'supervisor' => 1,
            'email' => 'kepsek@abc.com',
            'password' => Hash::make('1102'),
        ]);

    }
}
