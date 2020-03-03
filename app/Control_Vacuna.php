<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Control_Vacuna extends Model
{

    protected $table='control_vacunas';

    protected $filiable=['legajo_id',
    	'porcentaje','estado','color'];
	
	
     public function controlVacuna(){
        
        return $this->hasOne('App\Empleado','legajo','legajo_id');

    }

}
