<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Documentacion;

class TipoDocumentacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Documentacion::create(['id' => 36, 'valor' =>	"No Cedulado"]);
        Documentacion::create(['id' => 37, 'valor' =>	"Cedulado"]);
        Documentacion::create(['id' => 38, 'valor' =>	"Indocumentado"]);
    }
}
