<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{


    protected $table='areas';

    protected $filiable=[
    	'nombre', 'telefono'];
    	
}