<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jerarquia;

class JerarquiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jerarquia::create(['id' => 14000, 'valor' => "COMISIONADO"]);
        Jerarquia::create(['id' => 14001, 'valor' => "COMISIONADO AGREGADO"]);
        Jerarquia::create(['id' => 14002, 'valor' => "COMISIONADO JEFE"]);
        Jerarquia::create(['id' => 14003, 'valor' => "SUPERVISOR"]);
        Jerarquia::create(['id' => 14004, 'valor' => "SUPERVISOR AGREGADO"]);
        Jerarquia::create(['id' => 14005, 'valor' => "SUPERVISOR JEFE"]);
        Jerarquia::create(['id' => 14006, 'valor' => "OFICIAL"]);
        Jerarquia::create(['id' => 14007, 'valor' => "OFICIAL AGREGADO"]);
        Jerarquia::create(['id' => 14008, 'valor' => "OFICIAL JEFE"]);
    }
}
