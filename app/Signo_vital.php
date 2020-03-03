<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Signo_vital extends Model
{
	protected $table='signos_vitales';
    public function signos(){

    	return $this->hasOne('app\Consulta','id_legajo','legajo_id');
    }

    protected $filiable=[
    	'id_legajo','temperatura','sistolica','diastolica',
    	'frecuencia_arterial','frecuencia_respiratoria'
    ];
}
