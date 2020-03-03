<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enfermedad extends Model
{

	protected $table='enfermedades';
    // public function enfermedad(){

    // 	return $this->hasOne('app\Consulta','id_enfermedad','id');
    // }


    protected $filiable=[
		'nombre', 'reposo'];
}
