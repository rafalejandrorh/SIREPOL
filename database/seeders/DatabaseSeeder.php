<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            FuncionarioSeeder::class,
            PersonSeeder::class,
            CaracteristicasResennadoSeeder::class,
            EstatusFuncionarioSeeder::class,
            GeneroSeeder::class,
            GeografiaVenezuelaSeeder::class,
            JerarquiaSeeder::class,
            TipoDocumentacionSeeder::class,
            
        ]);
    }
}
