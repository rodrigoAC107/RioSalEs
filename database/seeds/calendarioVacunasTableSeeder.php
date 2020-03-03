<?php

use Illuminate\Database\Seeder;

class calendarioVacunasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'Gripe',
            'edadInicial' => '19',
            'edadFinal' => '26',
            'cantidad' => '1'
        ));
         \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'Gripe',
            'edadInicial' => '27',
            'edadFinal' => '49',
            'cantidad' => '1'
        ));
          \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'Gripe',
            'edadInicial' => '50',
            'edadFinal' => '64',
            'cantidad' => '1'

        ));
           \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'Tetanos',
            'edadInicial' => '19',
            'edadFinal' => '26',
            'cantidad' => '1'
        ));
           \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'Tetanos',
            'edadInicial' => '27',
            'edadFinal' => '49',
            'cantidad' => '1'
        ));
           \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'Tetanos',
            'edadInicial' => '50',
            'edadFinal' => '64',
            'cantidad' => '1'
        ));

            \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'Triple Viral',
            'edadInicial' => '19',
            'edadFinal' => '26',
            'cantidad' => '1 o 2'
        ));
            \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'Triple Viral',
            'edadInicial' => '27',
            'edadFinal' => '49',
            'cantidad' => '1 o 2'
        ));
             \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'Varicela',
            'edadInicial' => '19',
            'edadFinal' => '26',
            'cantidad' => '2'
        ));
              \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'Varicela',
            'edadInicial' => '27',
            'edadFinal' => '49',
            'cantidad' => '2'
        ));
               \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'Varicela',
            'edadInicial' => '50',
            'edadFinal' => '64',
            'cantidad' => '2'
        ));
              \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'HPV',
            'edadInicial' => '19',
            'edadFinal' => '26',
            'cantidad' => '3'
        ));
               \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'Herpes Zoster',
            'edadInicial' => '50',
            'edadFinal' => '64',
            'cantidad' => '1'
        ));
                \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'Neumococo Conjugada',
            'edadInicial' => '19',
            'edadFinal' => '26',
            'cantidad' => '1'
        ));
                \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'Neumococo Conjugada',
            'edadInicial' => '27',
            'edadFinal' => '49',
            'cantidad' => '1'
        ));
                \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'Neumococo Conjugada',
            'edadInicial' => '50',
            'edadFinal' => '64',
            'cantidad' => '1'
        ));
                \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'Neumococo Polisacarida',
            'edadInicial' => '19',
            'edadFinal' => '26',
            'cantidad' => '1 o 2'
        ));
                \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'Neumococo Polisacarida',
            'edadInicial' => '27',
            'edadFinal' => '49',
            'cantidad' => '1 o 2'
        ));
                \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'Neumococo Polisacarida',
            'edadInicial' => '50',
            'edadFinal' => '64',
            'cantidad' => '1 o 2'
        ));
                \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'Meningococo A',
            'edadInicial' => '19',
            'edadFinal' => '26',
            'cantidad' => '1 o mas'
        ));
                \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'Meningococo A',
            'edadInicial' => '27',
            'edadFinal' => '49',
            'cantidad' => '1 o mas'
        ));
                \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'Meningococo A',
            'edadInicial' => '50',
            'edadFinal' => '64',
            'cantidad' => '1 o mas'
        ));
                \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'Meningococo B',
            'edadInicial' => '19',
            'edadFinal' => '26',
            'cantidad' => '2'
        ));
                \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'Meningococo B',
            'edadInicial' => '27',
            'edadFinal' => '49',
            'cantidad' => '2'
        ));
                \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'Meningococo B',
            'edadInicial' => '50',
            'edadFinal' => '64',
            'cantidad' => '2'
        ));
                \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'Hepatitis A',
            'edadInicial' => '19',
            'edadFinal' => '26',
            'cantidad' => '2'
        ));
                \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'Hepatitis A',
            'edadInicial' => '27',
            'edadFinal' => '49',
            'cantidad' => '2'
        ));
                \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'Hepatitis A',
            'edadInicial' => '50',
            'edadFinal' => '64',
            'cantidad' => '2'
        ));
                \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'Hepatitis B',
            'edadInicial' => '19',
            'edadFinal' => '26',
            'cantidad' => '3'
        ));
                 \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'Hepatitis B',
            'edadInicial' => '27',
            'edadFinal' => '49',
            'cantidad' => '3'
        ));
                  \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'Hepatitis B',
            'edadInicial' => '50',
            'edadFinal' => '64',
            'cantidad' => '3'
        ));
                 \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'Heamophilus Influenzae tipo B',
            'edadInicial' => '19',
            'edadFinal' => '26',
            'cantidad' => '1 o 3'
        ));
                  \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'Heamophilus Influenzae tipo B',
            'edadInicial' => '27',
            'edadFinal' => '49',
            'cantidad' => '1 o 3'
        ));
                   \DB::table('calendario_vacunas')->insert(array(
            'nombre' => 'Heamophilus Influenzae tipo B',
            'edadInicial' => '50',
            'edadFinal' => '64',
            'cantidad' => '1 o 3'
        ));


    }
}
