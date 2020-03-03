<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imc extends Model
{

    protected $table='imc';
     /** * The attributes that should be mutated to dates. * * @var array */ 
     protected $dates = ['created_at']; 
     public function imc(){

    	return $this->hasOne('app\Empleados','legajo','legajo_id');
    }

    protected $filiable=[
    	'legajo_id','estatura','peso','calculo_imc','estado'
    ];

}
