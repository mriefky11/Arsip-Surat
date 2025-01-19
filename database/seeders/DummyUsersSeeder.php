<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'nrp' => 000,
                'role' => 'admin',
                'nama' => 'admin',
                'pangkat' => 'admin',
                'staff' => 'admin',
                'username' => 'admin',
                'password' => bcrypt('admin'),
            ],
            [
                'nrp' => 001,
                'role' => 'user',
                'nama' => 'user 1',
                'pangkat' => 'user',
                'staff' => 'user',
                'username' => 'user1',
                'password' => bcrypt('123'),
            ],
        ];

        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}
