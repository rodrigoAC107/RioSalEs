<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    protected $table='directores';

     public function area(){

		return $this->hasOne('App\Area','id','area_id');
	}
    protected $filiable=['nombre','apellido','legajo', 'area_id'];
}
