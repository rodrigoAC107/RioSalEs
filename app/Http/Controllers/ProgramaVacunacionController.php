<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Area;
use App\Carnet_Vacuna;
use App\Programa_vacunacion;
use App\Tipo_Rol;
use App\Empleado;
use App\Notificacion;
use App\Vacuna;
use App\Control_Vacuna;
use Carbon\Carbon;
use App\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ProgramaVacunacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas=Area::all();
        $carnet=Carnet_Vacuna::all();
        $notificar=Tipo_Rol::all();
        
        $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }
        $fechaDeHoy=Carbon::now();

        $fechaDeHoy=$fechaDeHoy->format('Y-m-d');

        


        return view('programaVacunacion.crear',compact('areas','carnet','notificar','notificaciones','contadorNotificacion','fechaDeHoy'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $guardar= new Programa_vacunacion;

        $guardar->nombre=$request->nombre_programa;
        $guardar->vacuna=$request->vacuna;
        $guardar->area=$request->area;
        $guardar->dosis=$request->dosis;
        $guardar->fecha=$request->fecha_programa;
        // $guardar->notificar=$request->notificar;
        $guardar->mensaje=$request->mensaje;
        $guardar->save();

        unset($guardar['created_at']);
        unset($guardar['updated_at']);

        ActivityLog::create([
            'log' => 'Programa Vacunacion',
            'descripcion' => 'Created',
            'fecha' => new \DateTime(),
            'responsable' => Auth::user()->email,
            'detalles' => json_encode($guardar)
        ]);



        $guardar2= new Notificacion;
        $guardar2->nombre=$request->nombre_programa;
        $guardar2->mensaje=$request->mensaje;
        // $guardar2->usuario=$request->notificar;
        $guardar2->fecha=$request->fecha_programa;
        $guardar2->area=$request->area;
        $guardar2->save();

        unset($guardar2['created_at']);
        unset($guardar2['updated_at']);

        ActivityLog::create([
            'log' => 'Notificacion',
            'descripcion' => 'Created',
            'fecha' => new \DateTime(),
            'responsable' => Auth::user()->email,
            'detalles' => json_encode($guardar2)
        ]);


        return redirect()->route('programaVacunacion.index')->with('guardado','PROGRAMA CREADO CON EXITO');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }

         $fechaDeHoy=Carbon::now();

        $fechaDeHoy=$fechaDeHoy->format('d-m-yy');

        // dd($fechaDeHoy);

        $programa=Programa_vacunacion::where('id',$id)->get();
        // dd($id);
        $fechaPrograma;
        foreach ($programa as $prog) {
            $fechaPrograma=$prog->fecha;
        }
        
        $fechaPrograma=date('d-m-yy',strtotime($fechaPrograma));

        return view('programaVacunacion.vistaNotificacion',compact('notificaciones','contadorNotificacion','programa','fechaDeHoy','fechaPrograma'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }

        $programa=Programa_vacunacion::where('id',$id)->get();
        $area;
        $vacuna;
        $fechaPrograma;
        $dosis;
        $numeroPrograma;
        foreach ($programa as $prog) {
            $area=$prog->area;
            $vacuna=$prog->vacuna;
            $fechaPrograma=$prog->fecha;
            $dosis=$prog->dosis;
            $numeroPrograma=$prog->id;

        }
        $fechaPrograma=date('d-m-yy',strtotime($fechaPrograma));
        $empleados=Empleado::where('area_trabajo',$area)->get();
        
        
        return view('programaVacunacion.programaVacunacion',compact('notificaciones','contadorNotificacion','empleados','area','fechaPrograma','vacuna','dosis','numeroPrograma'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function cargarVacunaPrograma(Request $request)
    {
        $vacunas=Vacuna::where('legajo_id',$request->legajo)->where('nombre',$request->vacuna)->get();
        $controles=Control_Vacuna::where('legajo_id',$request->legajo)->get();
        $id=$request->numero;
        if($vacunas->isNotEmpty()){
       foreach ($vacunas as $vacuna) {
           
            if ($vacuna->estado=="Incompleto" || $vacuna->estado==null) {

                    if ($vacuna->nombre=="Gripe" || $vacuna->nombre=="Tetanos" ||  $vacuna->nombre=="Triple Viral" ||  $vacuna->nombre=="Neumococo Conjugada" || $vacuna->nombre=="Neumococo Polisacarida" ||  $vacuna->nombre=="Meningococo A" || $vacuna->nombre=="Heamophilus Influenzae tipo B" || $vacuna->nombre=="Herpes Zoster") {
                        if ($request->dosis=="Primera Dosis") {
                            $vacuna->estado="Completo";
                            $vacuna->fecha=$request->fecha;
                            $vacuna->dosis_1=$request->dosis;
                        }elseif ($request->dosis!="Primera Dosis") {
                            return redirect()->route('programaVacunacion.edit',compact('id'))->with('error','Dosis Erronea, Verificar');
                        }
                     

                    }elseif ($vacuna->nombre=="Varicela" || $vacuna->nombre=="Meningococo B" || $vacuna->nombre=="Hepatitis A") {
                        if ($request->dosis=="Primera Dosis") {
                            $vacuna->estado="Incompleto";
                            $vacuna->fecha=$request->fecha;
                            $vacuna->dosis_1=$request->dosis;
                        }elseif($request->dosis=="Segunda Dosis" && $vacuna->dosis_1=="Primera Dosis"){
                            $vacuna->estado="Completo";
                            $vacuna->fecha=$request->fecha;
                            $vacuna->dosis_2=$request->dosis;
                        }elseif ($request->dosis="Tercera Dosis") {
                            return redirect()->route('programaVacunacion.edit',compact('id'))->with('error','Dosis Erronea, Verificar');
                        }
                    }elseif ($vacuna->nombre=="HPV" || $vacuna->nombre=="Hepatitis B") {
                        if ($request->dosis=="Primera Dosis") {
                            $vacuna->estado="Incompleto";
                            $vacuna->fecha=$request->fecha;
                            $vacuna->dosis_1=$request->dosis;
                        }elseif($request->dosis=="Segunda Dosis" && $vacuna->dosis_1=="Primera Dosis"){
                            $vacuna->estado="Incompleto";
                            $vacuna->fecha=$request->fecha;
                            $vacuna->dosis_2=$request->dosis;
                        }elseif ($request->dosis=="Tercera Dosis" && $vacuna->dosis_1=="Primera Dosis" && $vacuna->dosis_2=="Segunda Dosis") {
                            $vacuna->estado="Completo";
                            $vacuna->fecha=$request->fecha;
                            $vacuna->dosis_3=$request->dosis;
                        }else{
                            return redirect()->route('programaVacunacion.edit',compact('id'))->with('error','Dosis Erronea, Verificar');
                        }
                    }
               

                    
                foreach ($controles as $control) {
                             $control->cantidad++;
                             $calculo=($control->cantidad*100)/$control->total_vacunas;
                             $control->porcentaje=$calculo;
                             if($control->porcentaje<=25){
                                $control->color="alert-danger";
                             }elseif($control->porcentaje>25 && $control->porcentaje<99){
                                $control->estado="Intermedio";
                                $control->color="alert-warning";
                             }elseif ($control->porcentaje==100) {
                                $control->estado="Completo";
                                $control->color="alert-success";

                             }
                             $control->update();
                         
                    }
               
            }elseif($vacuna->estado=="Completo"){
                 return redirect()->route('programaVacunacion.edit',compact('id'))->with('error','Dosis Completas!!!');
            }
           }
           $vacuna->update();

        return redirect()->route('programaVacunacion.edit',compact('id'))->with('guardado','Vacuna cargada con Exito!!!');
        }else{
            return redirect()->route('programaVacunacion.edit',compact('id'))->with('error','El paciente no necesita la vacuna por su Edad');
        }
    }



    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
