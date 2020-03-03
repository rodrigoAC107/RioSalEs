<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AntecedentesEmpleado extends Model
{

    protected $table='antecedentes_empleados';

    protected $filiable=[
    	'legajo_id',
    	'tipo',
    	'observacion'
    ];
    

    public function consultas(){

    	return $this->hasMany('app\Consulta','id','consultas_id');
    }
}

