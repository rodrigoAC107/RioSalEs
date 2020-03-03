<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $table='notificacion';


    protected $filable=[
    	'nombre','mensaje','fecha','area','usuario'];
}
