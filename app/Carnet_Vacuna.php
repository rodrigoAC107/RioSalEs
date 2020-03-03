<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carnet_Vacuna extends Model
{
    protected $table='calendario_vacunas';

    public function vacunas(){

    	return $this->hasMany('App\Vacuna','nombre','id');
    }
}
