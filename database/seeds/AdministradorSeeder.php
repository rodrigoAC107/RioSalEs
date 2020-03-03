<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdministradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert(array(
            'nombre' => 'Rodrigo',
            'apellido' => 'Acosta',
            'email' => 'rodrigoacosta1115@gmail.com',
            'rol_id' => 1,
            'dni' => 41529284,
            'password' => Hash::make(41529284),
            'remember_token' => str_random(10),
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')

        ));
        \DB::table('users')->insert(array(
            'nombre' => 'Alejandro',
            'apellido' => 'Hourcade',
            'email' => 'alehourcade14@gmail.com',
            'rol_id' => 1,
            'dni' => 37655176,
            'password' => Hash::make(12345678),
            'remember_token' => str_random(10),
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')

        ));

    }
}
