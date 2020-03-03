<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Empleado;
use App\Dieta;
use App\Notificacion;
use Carbon\Carbon;
use App\Comidas_Dietas;
use App\ActivityLog;
use Illuminate\Support\Facades\Auth;
class DietaController extends Controller
{
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

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }
        $comidas=Comidas_Dietas::all();

        return view('empleados.dietas',compact('notificaciones','contadorNotificacion','comidas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validar = Empleado::where('legajo',$request->legajo_id)->get();
        $validarDieta=Dieta::where('legajo_id',$request->legajo_id)->get();

        if ($validar->isNotEmpty()) {
          if(isset($validarDieta)){    
            $dietas= new Dieta;
            $dietas->legajo_id=$request->legajo_id;
            if (isset($request->tipo1) && !isset($request->tipo2)) {
               $dietas->tipo_1=$request->tipo1;
            }elseif(isset($request->tipo1) && isset($request->tipo2)){
                $dietas->tipo_1=$request->tipo1;
                $dietas->tipo_2=$request->tipo2;
            }
            if(isset($request->come) && !isset($request->come2)){
                $dietas->comidas_permitidas=$request->come;
            }elseif(isset($request->come) && isset($request->come2)){
                $dietas->comidas_permitidas=$request->come.",".$request->come2;
            }
            if(isset($request->no_come) && !isset($request->no_come2)){
                $dietas->comidas_no_permitidas=$request->no_come;
            }elseif (isset($request->no_come) && isset($request->no_come2)) {
                $dietas->comidas_no_permitidas=$request->no_come.",".$request->no_come2;
            }

        
            $dietas->save();

            unset($dietas['created_at']);
            unset($dietas['updated_at']);

            ActivityLog::create([
                  'log' => 'Dietas',
                  'descripcion' => 'Created',
                  'fecha' => new \DateTime(),
                  'responsable' => Auth::user()->email,
                  'detalles' => json_encode($dietas)
            ]);

          }else{
            foreach ($validarDieta as $dietas) {
            $dietas->legajo_id=$request->legajo_id;
                if (isset($request->tipo1) && !isset($request->tipo2)) {
                   $dietas->tipo_1=$request->tipo1;
                }elseif(isset($request->tipo1) && isset($request->tipo2)){
                    $dietas->tipo_1=$request->tipo1;
                    $dietas->tipo_2=$request->tipo2;
                }
                if(isset($request->come) && !isset($request->come2)){
                    $dietas->comidas_permitidas=$request->come;
                }elseif(isset($request->come) && isset($request->come2)){
                    $dietas->comidas_permitidas=$request->come.",".$request->come2;
                }
                if(isset($request->no_come) && !isset($request->no_come2)){
                    $dietas->comidas_no_permitidas=$request->no_come;
                }elseif (isset($request->no_come) && isset($request->no_come2)) {
                    $dietas->comidas_no_permitidas=$request->no_come.",".$request->no_come2;
                }
                 $dietas->update();
            }
            

          }

        

          return redirect()->route('dieta.create')->with(['guardado'=>'Dieta guardada con exito']);
        }else{
            return redirect()->route('dieta.create')->with(['error'=>'No existe ese legajo']);
        }
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
        $request->validate([
            'tipo' => 'string',
            'comidas_permitidas' => 'string',
            'comidas_no_permitidas'=>'string'
        ]);

        $Dieta = Dieta::where('id',$request->dietaId)->get();
        
        foreach ($Dieta as $dieta) {
            $dietaOld = new Comidas_Dietas();
            $dietaOld->legajo_id = $dieta->legajo_id;
            $dietaOld->tipo_1 = $dieta->tipo_1;
            $dietaOld->tipo_2=$dieta->tipo_2;
            $dietaOld->comidas_permitidas = $dieta->comidas_permitidas;
            $dietaOld->comidas_no_permitidas = $dieta->comidas_no_permitidas;

            $dieta->tipo_1 = $request->tipo_1;
            $dieta->tipo_2=$request->tipo_2;
            $dieta->comidas_permitidas = $request->comidas_permitidas; 
            $dieta->comidas_no_permitidas=$request->comidas_no_permitidas;
        }

        $dieta->update();

        unset($dieta['created_at']);
        unset($dieta['updated_at']);

        ActivityLog::create([
            'log' => 'Dietas',
            'descripcion' => 'Updated',
            'fecha' => new \DateTime(),
            'responsable' => Auth::user()->email,
            'detalles' => 'old: '.json_encode($dietaOld).', new: '.json_encode($dieta)
        ]);

        return redirect()->route('empleado.datos', $id)->with('guardado','DIETA ACTUALIZADA');
    }


public function mostrarComida(Request $request){

        $comidas=Comidas_Dietas::where('tipo',$request->tipo)->get();


        
            foreach ($comidas as $comida) {
                if ($request->ajax()) {
                    return response()->json([
                     'tipo'=>$comida->tipo,
                     'come' => $comida->come,
                     'no_come'=>$comida->no_come
                     
                    ]);
                        }
    }
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
