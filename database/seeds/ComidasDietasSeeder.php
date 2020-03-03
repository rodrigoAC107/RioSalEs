<?php

use Illuminate\Database\Seeder;

class ComidasDietasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
    {
       \DB::table('comidas_dietas')->insert(array(
            'tipo' => 'Vegetariano',
            'come'=>'Cereales,Frutas,Verduras,Hortalizas, Legumbres,Frutos Secos',
            'no_come'=>'Carne de vaca, carne de pescado,carne de pollo'            

        ));
       \DB::table('comidas_dietas')->insert(array(
            'tipo' => 'General',
            'come'=>'Todas las comidas permitidas',
            'no_come'=>''            

        ));
       \DB::table('comidas_dietas')->insert(array(
            'tipo' => 'Diabéticios',
            'come'=>'Frutas,Verduras,Cereales integrales,Legumbres, Lacteos Descremados, Carnes Desgrasadas,Pan Integral',
            'no_come'=>'Bananas, Uva, Higo, Bebidas con azucar, Golocinas, Productos de panaderia, Hidratos de Carbono'            

        ));
       \DB::table('comidas_dietas')->insert(array(
            'tipo' => 'Hipo Sodica',
            'come'=>'Leche descremada, Quesos sin sal, Huevos, Carnes, Frutas, Cereales Integrales,Pan y Galletas sin Sal',
            'no_come'=>'Fiambres, Embutidos, Quesos Comunes,Manteca,Hamburguesas, Pan,Facturas,Tortas, Polvo de Hornear, Harinas Leudantes'            

        ));
       \DB::table('comidas_dietas')->insert(array(
            'tipo' => 'Celiacos',
            'come'=>'Carnes,Pescados, Mariscos, Verduras, Frutas, Huevo, Leche y derivados, Jamon Serrano,Jamon Cocido, Arroz, Maiz,Azucar,Miel, Frutos Secos Crudos, Cafe',
            'no_come'=>'Trigo,Cebada,Centeno,Pan y Derivados,Pasteles,Productos de Reposteria, Galletas, Tartes, Pastas, Cerveza, '            

        ));
    }
}
