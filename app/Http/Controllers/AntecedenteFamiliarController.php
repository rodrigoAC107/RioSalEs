<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Empleado;
use App\AntecedentesFamiliares;
use App\Notificacion;
use Carbon\Carbon;
use App\ActivityLog;
use Illuminate\Support\Facades\Auth;

class AntecedenteFamiliarController extends Controller
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

        return view('empleados.antecedentesf',compact('notificaciones','contadorNotificacion'));
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

      if ($validar->isNotEmpty()) {
      $antecedentesf= new AntecedentesFamiliares;

      $antecedentesf->legajo_id=$request->legajo_id;
      $antecedentesf->tipo=$request->tipo;
      $antecedentesf->observacion=$request->observacion;
      $antecedentesf->save();

        unset($antecedentesf['created_at']);
        unset($antecedentesf['updated_at']);

        ActivityLog::create([
            'log' => 'Antecedentes Familiares',
            'descripcion' => 'Created',
            'fecha' => new \DateTime(),
            'responsable' => Auth::user()->email,
            'detalles' => json_encode($antecedentesf)
        ]);
         return redirect()->route('antecedenteFamiliar.create')->with(['guardado'=>'Antecedente guardado con exito']);
      }else{
         return redirect()->route('antecedenteFamiliar.create')->with(['error'=>'No existe ese legajo']);
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

        $Familiar = AntecedentesFamiliares::where('id',$request->familiarId)->get();
        
        foreach ($Familiar as $familiar) {
            $familiarOld = new AntecedentesFamiliares();
            $familiarOld->legajo_id = $familiar->legajo_id;
            $familiarOld->tipo = $familiar->tipo;
            $familiarOld->observacion = $familiar->observacion;

            $familiar->tipo = $request->tipo;
            $familiar->observacion = $request->observacion; 
        }

        $familiar->update();

        unset($familiar['created_at']);
        unset($familiar['updated_at']);

        ActivityLog::create([
            'log' => 'Antecedentes Familiares',
            'descripcion' => 'Updated',
            'fecha' => new \DateTime(),
            'responsable' => Auth::user()->email,
            'detalles' => 'old: '.json_encode($familiarOld).', new: '.json_encode($familiar)
        ]);

        return redirect()->route('empleado.datos', $id)->with('guardado','ANTECEDENTE FAMILIAR ACTUALIZADO');
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
