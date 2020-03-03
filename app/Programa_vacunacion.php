<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programa_vacunacion extends Model
{
    protected $table='programa_vacunacion';

    protected $filable=['nombre','vacuna','area','dosis','fecha','mensaje'];
}
