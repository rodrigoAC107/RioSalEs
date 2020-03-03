<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Control_Vacuna;
use App\Consulta;
use App\Donacion;
use App\Empleado;
use App\Notificacion;
use Carbon\Carbon;
use App\Dieta;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        //Cantidad de vacunas
       $cantidadVacunas=Control_Vacuna::all();

        $numeroDeVacunas=0;
        foreach ($cantidadVacunas as $cantidadVacuna) {
            
            $numeroDeVacunas=$cantidadVacuna->cantidad + $numeroDeVacunas;
        }
        
        //cantidad de consultas
        $cantidadConsultas=Consulta::all();

        $numeroDeConsultas=0;
        foreach ($cantidadConsultas as $cantidadConsulta) {
            $numeroDeConsultas=$cantidadConsulta->id;
        }

        //cantidad de donaciones
        $cantidadDeDonaciones=Donacion::all();


        $numeroDeDonaciones=0;
        foreach ($cantidadDeDonaciones as $cantidadDeDonacione) {
           $numeroDeDonaciones=$cantidadDeDonacione->total +$numeroDeDonaciones;
        }

        $cantidadEmpleados=Empleado::query();

        $numeroDeEmpleados=$cantidadEmpleados->count();
        
        
        //notificaciones

        $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }
        //Grafico 1
        $oNegativo = 0;
        $oPositivo = 0;
        $ABNegativo = 0;
        $ABPositivo = 0;
        $ANegativo = 0;
        $APositivo = 0;
        $BNegativo = 0;
        $BPositivo = 0;
        $empleado = Empleado::all();
        foreach ($empleado as $Empleado) {
            if($Empleado->grupo_sanguineo == 'O-'){
                $oNegativo++;
            }elseif($Empleado->grupo_sanguineo == 'O+'){
                $oPositivo++;
            }elseif($Empleado->grupo_sanguineo == 'AB-'){
                $ABNegativo++;
            }elseif($Empleado->grupo_sanguineo == 'AB+'){
                $ABPositivo++;
            }elseif($Empleado->grupo_sanguineo == 'A-'){
                $ANegativo++;
            }elseif($Empleado->grupo_sanguineo == 'A+'){
                $APositivo++;
            }elseif($Empleado->grupo_sanguineo == 'B-'){
                $BNegativo++;
            }elseif($Empleado->grupo_sanguineo == 'B+'){
                $BPositivo++;
            }

        }

        //Grafico 2
        $empleados=Dieta::all();
        $contadorGeneral=0;
        $contadorVegetariano=0;
        $contadorHipo=0;
        $contadorDiabe=0;
        $contadorCelia=0;
        foreach ($empleados as $empleado) {
            
                 if ($empleado->tipo_1=='General' || $empleado->tipo_2=='General') {
                $contadorGeneral++;
                }
                if ($empleado->tipo_1=='Vegetariano' || $empleado->tipo_2=='Vegetariano') {
                $contadorVegetariano++;   
                }
                if ($empleado->tipo_1=='Hipo Sodica' || $empleado->tipo_2=='Hipo Sodica') {
                $contadorHipo++;   
                }
                if ($empleado->tipo_1=='Diabéticios' || $empleado->tipo_2=='Diabéticios') {
                $contadorDiabe++;   
                }
                if ($empleado->tipo_1=='Celiacos' || $empleado->tipo_2=='Celiacos') {
                $contadorCelia++;   
                }
                
            
        }

       
        


        return view('home',compact('numeroDeVacunas','numeroDeConsultas','numeroDeDonaciones','numeroDeEmpleados','notificaciones','contadorNotificacion','oNegativo','oPositivo','ABNegativo','ABPositivo','ANegativo','APositivo','BNegativo','BPositivo','contadorGeneral','contadorVegetariano','contadorCelia','contadorDiabe','contadorHipo'));
    }
}
