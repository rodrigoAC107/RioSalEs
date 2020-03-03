<?php

use Illuminate\Database\Seeder;

class TipoRolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('tipo_rol')->insert(array(
           'nombre' => 'Administrador',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
    	));

    	\DB::table('tipo_rol')->insert(array(
           'nombre' => 'Medico',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
    	));
    	
    	\DB::table('tipo_rol')->insert(array(
           'nombre' => 'Enfermero',
           'created_at' => date('Y-m-d H:m:s'),
           'updated_at' => date('Y-m-d H:m:s')
    	));
    }
}
