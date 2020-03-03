<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DonacionAnio extends Model
{
    //

    protected $table='donacion_anio';

    protected $filiable=[
    	'legajo_id', 'anio_primero', 'estado_primero', 'anio_segundo', 'estado_segundo', 'anio_tercero', 'estado_tercero'];
}
