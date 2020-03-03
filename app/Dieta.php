<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dieta extends Model
{
	public function dieta(){

		return $this->hasOne('App\Empleado','legajo','legajo_id');
	}
	
    protected $table='dietas';
    
	protected $filiable=[
		'legajo_id','tipo_1','observacion','tipo_2',
		'comidas_permitidas','comidas_no_permitidas'
	];
}
