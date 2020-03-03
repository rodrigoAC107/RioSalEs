<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Riesgo extends Model
{
    protected $table='riesgos';

    protected $filiable=[
    	'area','enfermedad','riesgo'
    ];


}
