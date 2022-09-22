<?php

namespace Database\Seeders;


use App\Models\Funcionario;
use Illuminate\Database\Seeder;

class FuncionarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Funcionario::create([
            'credencial' => null,
            'id_jerarquia' => 14002,
            'telefono' => null,
            'id_person' => 1,
            'id_estatus' => 1310000
        ]);
    }
}
