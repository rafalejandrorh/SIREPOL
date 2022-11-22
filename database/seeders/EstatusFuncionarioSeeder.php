<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Estatus_Funcionario;

class EstatusFuncionarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estatus_Funcionario::create(['id' => 1310000, 'valor' => "ACTIVO"]);
        Estatus_Funcionario::create(['id' => 1310001, 'valor' => "DESTITUIDO"]);
        Estatus_Funcionario::create(['id' => 1310002, 'valor' => "EGRESADO"]);
        Estatus_Funcionario::create(['id' => 1310003, 'valor' => "FALLECIDO"]);
        Estatus_Funcionario::create(['id' => 1310004, 'valor' => "JUBILADO"]);
        Estatus_Funcionario::create(['id' => 1310005, 'valor' => "EN COMISIÓN"]);
        Estatus_Funcionario::create(['id' => 1310006, 'valor' => "INACTIVO"]);
        Estatus_Funcionario::create(['id' => 1310007, 'valor' => "EXCLUIDO"]);
        Estatus_Funcionario::create(['id' => 1310008, 'valor' => "PENSIONADO"]);
        Estatus_Funcionario::create(['id' => 1310009, 'valor' => "RENUNCIÓ"]);
        Estatus_Funcionario::create(['id' => 1310010, 'valor' => "SUSPENDIDO"]);
    }
}
