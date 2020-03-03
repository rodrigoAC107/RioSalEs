<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enfermedad_Empleado extends Model
{
    protected $table='enfermedad_empleado';

    public function enfermedad(){

		return $this->hasOne('App\Riesgo','enfermedad','enfermedad');
	}
	public function Rriesgo(){

		return $this->hasOne('App\Empleado','legajo','legajo_id');
	}
   protected $filable=['legajo_id','enfermedad'];


}