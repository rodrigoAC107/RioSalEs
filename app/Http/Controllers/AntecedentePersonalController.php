<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Empleado;
use App\AntecedentesEmpleado;
use App\Notificacion;
use Carbon\Carbon;
use App\Riesgo;
use App\Enfermedad_Empleado;
use App\ActivityLog;
use Illuminate\Support\Facades\Auth;
class AntecedentePersonalController extends Controller
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

        return view('empleados.antecedentesp',compact('notificaciones','contadorNotificacion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'legajo_id'=>'required|string|max:12',
          'tipo'=>'required|string|max:50',
          'observacion'=>'required|string|max:50'
      ]);

      $validar = Empleado::where('legajo',$request->legajo_id)->get();
      $validarRiesgo=Riesgo::where('area',$request->area)->where('enfermedad',$request->enfermedad)->get();
      if ($validar->isNotEmpty()) {
      $antecedentesp= new AntecedentesEmpleado;
      $riesgo= new Riesgo;

      $antecedentesp->legajo_id=$request->legajo_id;
      $antecedentesp->tipo=$request->tipo;
      $antecedentesp->observacion=$request->observacion;

      if(isset($request->riesgo)&&isset($request->riesgo)&&isset($request->riesgo)){
        if ($validarRiesgo->isNotEmpty()) {
            foreach ($validarRiesgo as $validarR) {
                $riesgoOld = new Riesgo;
                $riesgoOld->area = $validarR->area;
                $riesgoOld->riesgo = $validarR->riesgo;

                $validarR->area=$request->area;
                $validarR->enfermedad=strtolower($request->enfermedad);
                $validarR->riesgo=$request->riesgo;
            }
            $validarR->update();

            unset($validarR['created_at']);
            unset($validarR['updated_at']);

            ActivityLog::create([
                'log' => 'Riesgo',
                'descripcion' => 'Updated',
                'fecha' => new \DateTime(),
                'responsable' => Auth::user()->email,
                'detalles' => 'old: '.json_encode($riesgoOld).', new: '.json_encode($validarR)
            ]);
        }else{
            $riesgo->enfermedad=strtolower($request->enfermedad);
            $riesgo->area=$request->area;
            $riesgo->riesgo=$request->riesgo;
            $riesgo->save();

            unset($riesgo['created_at']);
            unset($riesgo['updated_at']);

            ActivityLog::create([
                'log' => 'Riesgo',
                'descripcion' => 'Created',
                'fecha' => new \DateTime(),
                'responsable' => Auth::user()->email,
                'detalles' => json_encode($riesgo)
            ]);
            }
      $Enfermedad_Empleado=new Enfermedad_Empleado;
      $Enfermedad_Empleado->legajo_id=$request->legajo_id;
      $Enfermedad_Empleado->enfermedad=strtolower($request->enfermedad);
      $Enfermedad_Empleado->area_trabajo=$request->area;
      $Enfermedad_Empleado->save();

        unset($Enfermedad_Empleado['created_at']);
        unset($Enfermedad_Empleado['updated_at']);

        ActivityLog::create([
            'log' => 'Enfermedad Empleado',
            'descripcion' => 'Created',
            'fecha' => new \DateTime(),
            'responsable' => Auth::user()->email,
            'detalles' => json_encode($Enfermedad_Empleado)
        ]);
      }
      $antecedentesp->save();

        unset($antecedentesp['created_at']);
        unset($antecedentesp['updated_at']);

        ActivityLog::create([
            'log' => 'Antecedentes Personales',
            'descripcion' => 'Created',
            'fecha' => new \DateTime(),
            'responsable' => Auth::user()->email,
            'detalles' => json_encode($antecedentesp)
        ]);
      
     


         return redirect()->route('antecedentePersonal.create')->with(['guardado'=>'Antecedente guardado con exito']);
      }else{
         return redirect()->route('antecedentePersonal.create')->with(['error'=>'No existe ese legajo']);
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
            'observacion' => 'string'
        ]);

        $Empleado = AntecedentesEmpleado::where('id',$request->empleadoId)->get();
        
        foreach ($Empleado as $empelado) {

            $familiarOld = new AntecedentesEmpleado();
            $familiarOld->legajo_id = $empelado->legajo_id;
            $familiarOld->tipo = $empelado->tipo;
            $familiarOld->observacion = $empelado->observacion;

            $empelado->tipo = $request->tipo;
            $empelado->observacion = $request->observacion; 
        }

        $empelado->update();

        unset($empelado['created_at']);
        unset($empelado['updated_at']);

        ActivityLog::create([
            'log' => 'Antecedentes Empleado',
            'descripcion' => 'Updated',
            'fecha' => new \DateTime(),
            'responsable' => Auth::user()->email,
            'detalles' => 'old: '.json_encode($familiarOld).', new: '.json_encode($empelado)
        ]);

        return redirect()->route('empleado.datos', $id)->with('guardado','ANTECEDENTE PERSONAL ACTUALIZADO');
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



    public function mostrarArea(Request $request){

        $Empleado=Empleado::where('legajo',$request->legajo_id)->get();

        // dd($Empleado);
        
            foreach ($Empleado as $emp) {
                if ($request->ajax()) {
                    return response()->json([
                     'legajo_id'=>$emp->legajo,
                     'area_trabajo' => $emp->area_trabajo
                     
                     
                    ]);
                }
            }
    }

}
