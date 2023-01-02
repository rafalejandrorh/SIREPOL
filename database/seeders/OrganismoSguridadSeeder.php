<?php

namespace Database\Seeders;

use App\Models\Organismos_Seguridad;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganismoSguridadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Organismos_Seguridad::create(['id' => 1, 'nombre' => 'Cuerpo de Investigaciones Científicas, Penales y Criminalísticas', 'abreviatura' => 'CICPC', 'id_padre' => null]);
        Organismos_Seguridad::create(['id' => 2, 'nombre' => 'Cuerpo de Policía Nacional Bolivariana', 'abreviatura' => 'CPNB', 'id_padre' => null]);
        Organismos_Seguridad::create(['id' => 3, 'nombre' => 'Servicio Bolivariano de Inteligencia Nacional', 'abreviatura' => 'SEBIN', 'id_padre' => null]);
        Organismos_Seguridad::create(['id' => 4, 'nombre' => 'Dirección General de Contrainteligencia Militar', 'abreviatura' => 'DGCIM', 'id_padre' => null]);
        Organismos_Seguridad::create(['id' => 5, 'nombre' => 'Guardia Nacional Bolivariana', 'abreviatura' => 'GNB', 'id_padre' => null]);
        Organismos_Seguridad::create(['id' => 6, 'nombre' => 'Comando Nacional Aintextorsion y Secuestro', 'abreviatura' => 'CONAS', 'id_padre' => 5]);
        Organismos_Seguridad::create(['id' => 7, 'nombre' => 'Minsiterio del Poder Popular para Relaciones Interiores, Justicia y Paz', 'abreviatura' => 'MPPRIJP', 'id_padre' => null]);
        Organismos_Seguridad::create(['id' => 8, 'nombre' => 'Minsiterio del Poder Popular para la Defensa', 'abreviatura' => 'MPPD', 'id_padre' => null]);
    }
}
