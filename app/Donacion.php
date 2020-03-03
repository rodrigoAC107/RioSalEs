<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donacion extends Model
{

    protected $table='donaciones';

    protected $fillable = [
        'legajo_id', 'fecha_1', 'fecha_2','fecha_3','total'
    ];

    public function empleado(){

		return $this->hasOne('App\Empleado','legajo','legajo_id');
	}
}
