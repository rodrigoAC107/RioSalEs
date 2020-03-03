<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = ['id','log','descripcion', 'fecha', 'responsable', 'detalles'];
}
