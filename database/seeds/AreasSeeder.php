<?php

use Illuminate\Database\Seeder;

class AreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	\DB::table('areas')->insert(array(
           'nombre' => 'Gerencia',
           'telefono' => null
    	));
         \DB::table('areas')->insert(array(
           'nombre' => 'Mantenimiento',
           'telefono' => null
    	));
         \DB::table('areas')->insert(array(
           'nombre' => 'Produccion',
           'telefono' => null
    	));\DB::table('areas')->insert(array(
           'nombre' => 'Control de Procesos',
           'telefono' => null
    	));
    	\DB::table('areas')->insert(array(
           'nombre' => 'Deposito',
           'telefono' => null
    	));
    	\DB::table('areas')->insert(array(
           'nombre' => 'Control de Calidad',
           'telefono' => null
    	));
    	\DB::table('areas')->insert(array(
           'nombre' => 'Programacion',
           'telefono' => null
    	));
    	\DB::table('areas')->insert(array(
           'nombre' => 'Sistemas',
           'telefono' => null
    	));
    	\DB::table('areas')->insert(array(
           'nombre' => 'RR HH',
           'telefono' => null
    	));
      \DB::table('areas')->insert(array(
           'nombre' => 'Comedor',
           'telefono' => null
      ));
    }
}
