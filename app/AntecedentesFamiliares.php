<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AntecedentesFamiliares extends Model
{
    
    protected $table='antecedentes_familiares';
    

    protected $filiable=[
    	'legajo_id',
    	'tipo','observacion'
    ];
   
}
