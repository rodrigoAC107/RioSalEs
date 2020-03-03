<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Consulta;
use App\Empleado;
use App\Enfermedad;
use App\Signo_vital;
use App\AntecedentesEmpleado;
use App\Notificacion;
use Carbon\Carbon;
use App\ActivityLog;
use Illuminate\Support\Facades\Auth;
class ConsultaController extends Controller
{
   public function indexConsulta(Request $request){

   	$enfermedad2=Enfermedad::all();
       $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }


   	return view('consultas.cargarConsultas',compact('enfermedad2','notificaciones','contadorNotificacion'));

   }
  


   public function guardarEnfermedad(Request $request){

   		$request->validate([
   			'nombre'=>'required|string|max:50',
   			'reposo'=>'required|string|max:20']);

   		$enfermedad= new Enfermedad;

   		$enfermedad->nombre=$request->nombre;
   		$enfermedad->reposo=$request->reposo;

   		$enfermedad->save();

   	 return redirect()->route('consultas.cargarConsultas')->with(['guardado'=>'Enfermedad guardada con exito, por favor vuelva a ingresar los datos']);
   }


   public function guardarConsultas(Request $request){

   		$request->validate([
   			'legajo_id'=>'required|string|max:50',
   			'fecha_consulta'=>'required|string|max:20',
   			'tipo_consulta'=>'required|string|max:20',
   			'motivo'=>'required|string',
   			'temperatura'=>'required|string|max:20',
   			'sistolica'=>'required|string|max:20',
   			'diastolica'=>'required|string|max:20',
   			'frecuencia_arterial'=>'required|string|max:20',
   			'frecuencia_respiratoria'=>'required|string|max:20']);
         
         
            // $enfermedad=Enfermedad::where('nombre',$request->enfermedad_id)->first();
            $validar = Empleado::where('legajo',$request->legajo_id)->get();
             if ($validar->isNotEmpty()) {
            $signos= new Signo_vital;
            $signos->legajo_id=$request->legajo_id;
            $signos->temperatura=$request->temperatura;
            $signos->sistolica=$request->sistolica;
            $signos->diastolica=$request->diastolica;
            $signos->frecuencia_arterial=$request->frecuencia_arterial;
            $signos->frecuencia_respiratoria=$request->frecuencia_respiratoria;
            $signos->save();

            unset($signos['created_at']);
            unset($signos['updated_at']);

            ActivityLog::create([
                  'log' => 'Signo Vital',
                  'descripcion' => 'Created',
                  'fecha' => new \DateTime(),
                  'responsable' => Auth::user()->email,
                  'detalles' => json_encode($signos)
            ]);

      		$consulta= new Consulta;
      		$consulta->legajo_id=$request->legajo_id;
            // $consulta->enfermedad_id=$enfermedad->id;
            $consulta->signo_id=$signos->id;
      		$consulta->fecha_consulta=$request->fecha_consulta;
      		$consulta->tipo_consulta=$request->tipo_consulta;
      		$consulta->motivo=$request->motivo;
            $consulta->save();
            
            unset($consulta['created_at']);
            unset($consulta['updated_at']);

            ActivityLog::create([
                  'log' => 'Consulta',
                  'descripcion' => 'Created',
                  'fecha' => new \DateTime(),
                  'responsable' => Auth::user()->email,
                  'detalles' => json_encode($consulta)
            ]);

            $antecedente= new AntecedentesEmpleado;
            $antecedente->legajo_id=$request->legajo_id;
      		$antecedente->tipo="consulta";
            $antecedente->consulta_id=$consulta->id;
            $antecedente->observacion=$consulta->motivo;
            $antecedente->save();

            unset($antecedente['created_at']);
            unset($antecedente['updated_at']);

            ActivityLog::create([
                  'log' => 'Antecedentes Empleado',
                  'descripcion' => 'Created',
                  'fecha' => new \DateTime(),
                  'responsable' => Auth::user()->email,
                  'detalles' => json_encode($antecedente)
            ]);


            return redirect()->route('consultas.cargarConsultas')->with(['guardado'=>'Consulta creada con exito']);
         }else{
            return redirect()->route('consultas.cargarConsultas')->with(['error'=>'El legajo ingresado no existe']);
         }
   }



   public function historiaClinica(){
      $enfermedad2=Enfermedad::all();
       $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }
        return view('consultas.historiaClinica',compact('contadorNotificacion','notificaciones'));
   }




   public function historiaParticular(Request $request){
       $enfermedad2=Enfermedad::all();
       $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }
        
        $validar = Empleado::where('legajo',$request->legajo_id)->get();
        if ($validar->isNotEmpty()) {
         $datosNombre=Consulta::where('legajo_id',$request->legajo_id)->take(1)->get();
          $datos=Consulta::where('legajo_id',$request->legajo_id)->get();
          if($datos->isEmpty()){
            return redirect()->route('consultas.historiaClinica')->with(['error'=>'El paciente no tiene consultas cargadas']);
          }
          return view('consultas.historiaClinicaResultado',compact('contadorNotificacion','notificaciones','datos','datosNombre'));
        }else{
          return redirect()->route('consultas.historiaClinica')->with(['error'=>'El legajo no existe, corrobore que sea correcto']);
        }
       
      
   }
}
