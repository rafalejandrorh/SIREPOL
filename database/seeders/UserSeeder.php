<?php

namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Superadmin',
            'email' => 'generico@gmail.com',
            'id_funcionario' => null,
            'password' => bcrypt('12345678')
        ])->assignRole('Superadmin');

        User::create([
            'name' => 'Rafael Rivero',
            'email' => 'rafalejandrorivero@gmail.com',
            'id_funcionario' => null,
            'password' => bcrypt('27903883')
        ])->assignRole('Superadmin');

    }
}
