<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Empleado;
use App\Vacuna;
use App\Carnet_Vacuna;
use App\Control_Vacuna;
use App\Notificacion;
use Carbon\Carbon;
class VacunasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $controles=Control_Vacuna::all();
        $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }

     

        
        return view('vacunacion.index',compact('controles','notificaciones','contadorNotificacion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vacunas=Vacuna::where('legajo_id',$id)->get();
        $empleados=Empleado::where('legajo',$id)->get();

        $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }

      
        return view('vacunacion.cargarVacuna',compact('vacunas','empleados','notificaciones','contadorNotificacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( Request $request ,$id)
    {   

        $vacunas=Vacuna::where('legajo_id',$id)->where('nombre',$request->nombre)->get();


        $controles=Control_Vacuna::where('legajo_id',$id)->get();

       
       foreach ($vacunas as $vacuna) {
           
            if ($vacuna->estado=="Incompleto" || $vacuna->estado==null) {

                    if ($vacuna->nombre=="Gripe" || $vacuna->nombre=="Tetanos" ||  $vacuna->nombre=="Triple Viral" ||  $vacuna->nombre=="Neumococo Conjugada" || $vacuna->nombre=="Neumococo Polisacarida" ||  $vacuna->nombre=="Meningococo A" || $vacuna->nombre=="Heamophilus Influenzae tipo B" || $vacuna->nombre=="Herpes Zoster") {
                        if ($request->dosis=="Primera Dosis") {
                            $vacuna->estado="Completo";
                            $vacuna->fecha=$request->fecha;
                            $vacuna->dosis_1=$request->dosis;
                        }elseif ($request->dosis!="Primera Dosis") {
                            return redirect()->route('vacunas.index')->with('error','Dosis Erronea, Verifar');
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
                            return redirect()->route('vacunas.index')->with('error','Dosis Erronea, Verifar');
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
                            return redirect()->route('vacunas.index')->with('error','Dosis Erronea, Verifar');
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
                 return redirect()->route('vacunas.index')->with('error','Dosis Completas!!!');
            }
           }

           $vacuna->update();

        return redirect()->route('vacunas.index')->with('guardado','Vacuna cargada con Exito!!!');
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    public function mostrarVacunas($id){

        $vacunas=Vacuna::where('legajo_id',$id)->get();

        foreach ($vacunas as $vacuna) {
            $nombre=$vacuna->relacionVacunas;
            foreach ($nombre as $nom) {
                $datoNombre=$nom->nombre;
                $datoApellido=$nom->apellido;
            }
        }
        $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }



        return view('vacunacion.mostrarVacunas',compact('vacunas','datoNombre','datoApellido','notificaciones','contadorNotificacion'));
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
