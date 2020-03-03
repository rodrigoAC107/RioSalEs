<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Empleado;
use App\Imc;
use App\Notificacion;
use Carbon\Carbon;
use App\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ImcController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;
        $legajo2=Imc::all();

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }

       return view('consultas.imc', compact('notificaciones','contadorNotificacion','legajo2')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validar = Empleado::where('legajo',$request->legajo)->get();
         if ($validar->isNotEmpty()) {
         $legajo = Imc::where('legajo_id', $request->legajo)->orderby('created_at','DESC')->take(1)->get();
         
        $legajo2=Imc::where('legajo_id',$request->legajo)->get();
    
        
         $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }
            return view('consultas.cargar',compact('legajo','notificaciones','contadorNotificacion','legajo2'));
        }else{
            return redirect()->route('imc.create')->with(['error'=>'No existe ese legajo']);
        }
        

    }
     public function guardar(Request $request){

        $guardar= new Imc;
        $guardar->legajo_id=$request->legajo;
        $guardar->peso=$request->peso;
        $guardar->estatura=$request->estatura;
        //calculo del imc para los empleados cuando los cargamos
        $calculo1=($guardar->estatura/100)*($guardar->estatura/100);
        settype($calculo1, "float");
        $calculo2=$guardar->peso/$calculo1;
        settype($calculo2, "float");
        $guardar->calculo_imc=$calculo2;
        

        if ($calculo2<18.5) {
          $guardar->estado="Bajo Peso";
      }elseif ($calculo2>=18.5 && $calculo2<=24.9) {
          $guardar->estado="Peso Normal";
      }elseif ($calculo2==25) {
          $guardar->estado="Sobrepeso";
      }elseif ($calculo2>25 && $calculo2<=29.9) {
          $guardar->estado="Preobesidad";
      }elseif ($calculo2>=30 && $calculo2<=34.9) {
          $guardar->estado="Obesidad Clase 1";
      }elseif($calculo2>=35 && $calculo2<=39.9){
          $guardar->estado="Obesidad Clase 2";
      }elseif ($calculo2>=40) {
          $guardar->estado="Obesidad Clase 3";
      }
      if($guardar->estado=="Bajo Peso"){
        $guardar->color="alert-warning";
      }elseif($guardar->estado=="Peso Normal"){
        $guardar->color="alert-success";
      }elseif ($guardar->estado=="Sobrepeso" ||  $guardar->estado=="Preobesidad" || $guardar->estado=="Obesidad Clase 1" ||$guardar->estado=="Obesidad Clase 2" || $guardar->estado="Obesidad Clase 3" ) {
        $guardar->color="alert-danger";
      }
      $guardar->save();

      unset($guardar['created_at']);
      unset($guardar['updated_at']);
      unset($guardar['color']);

        ActivityLog::create([
            'log' => 'IMC',
            'descripcion' => 'Created',
            'fecha' => new \DateTime(),
            'responsable' => Auth::user()->email,
            'detalles' => json_encode($guardar)
        ]);

        $legajo = Imc::where('legajo_id', $request->legajo)->orderby('created_at','DESC')->take(1)->get();
         
        $legajo2=Imc::where('legajo_id',$request->legajo)->get();
    
        
         $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }
            return view('consultas.cargar',compact('legajo','notificaciones','contadorNotificacion','legajo2'));
      // // return $this->create();
      // return redirect()->route('imc.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
