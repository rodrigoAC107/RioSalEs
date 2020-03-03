<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habito extends Model
{

    protected $table='habitos';

    public function habitos(){

    	return $this->hasOne('app\Empleados','legajo','legajo_id');
    }
}
