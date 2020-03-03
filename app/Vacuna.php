<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacuna extends Model
{
   protected $table='vacunas';

   protected $filiable=[
   	'legajo_id','nombre','fecha','dosis_1','dosis_2','dosis_3','estado'];


   	public function relacionVacunas(){
		
		return $this->hasMany('App\Empleado','legajo','legajo_id');
    
    }
}
