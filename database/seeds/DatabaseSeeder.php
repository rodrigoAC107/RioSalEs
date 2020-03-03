<?php

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
        $this->call(AdministradorSeeder::class);
        $this->call(AreasSeeder::class);
        $this->call(calendarioVacunasTableSeeder::class);
        $this->call(ComidasDietasSeeder::class);
        $this->call(TipoRolSeeder::class);
    }
}
