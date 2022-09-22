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
            'users' => 'Superadmin',
            'id_funcionario' => 1,
            'password' => bcrypt('sup3r4dm1n*2022')
        ])->assignRole('Superadmin');
    }
}
