<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
	public function consulta(){
		return $this->hasOne('App\Empleado','legajo','legajo_id');
	}
	
	public function enfermedad(){

    	return $this->hasOne('app\Enfermedad','id','enfermedad_id');
    }
    public function signos(){

        return $this->hasOne('App\Signo_vital','id','signo_id');
    }
    protected $filiable=[
    	'legajo_id','enfermedad_id',
    	'fecha_consulta','tipo_consulta',
    	'motivo'
    ];
}
