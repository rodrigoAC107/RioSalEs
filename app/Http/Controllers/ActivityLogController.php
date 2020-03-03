<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Notificacion;
use App\ActivityLog;

class ActivityLogController extends Controller
{
    public function index(){
        $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }

    $actividades = ActivityLog::orderBy('id', 'DESC')->get();


        return view('log.index', compact('actividades','notificaciones','contadorNotificacion'));
    }
}
