<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Empleado;
use App\Alergia;
use Carbon\Carbon;
use App\Notificacion;
use App\ActivityLog;
use Illuminate\Support\Facades\Auth;
class AlergiaController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }

        return view('empleados.alergias',compact('notificaciones','contadorNotificacion'));

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
            $alergias= new Alergia;

            $alergias->legajo_id=$request->legajo_id;
            $alergias->tipo=$request->tipo;
            $alergias->observacion=$request->observacion;
            $alergias->save();

            unset($alergias['created_at']);
            unset($alergias['updated_at']);

            ActivityLog::create([
                'log' => 'Alergia',
                'descripcion' => 'Created',
                'fecha' => new \DateTime(),
                'responsable' => Auth::user()->email,
                'detalles' => json_encode($alergias)
            ]);

            return redirect()->route('alergia.create')->with(['guardado'=>'Alergia guardada con exito']);
        }else{
            return redirect()->route('alergia.create')->with(['error'=>'No existe ese legajo']);
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

        $Alergia = Alergia::where('id',$request->alergiaId)->get();

        foreach ($Alergia as $alergia) {

            $alergiaOld = new Alergia();
            $alergiaOld->legajo_id = $alergia->legajo_id;
            $alergiaOld->tipo = $alergia->tipo;
            $alergiaOld->observacion = $alergia->observacion;
            
            $alergia->tipo = $request->tipo;
            $alergia->observacion = $request->observacion; 
        }

        $alergia->update();

        
        unset($alergia['created_at']);
        unset($alergia['updated_at']);

        ActivityLog::create([
            'log' => 'Alergia',
            'descripcion' => 'Updated',
            'fecha' => new \DateTime(),
            'responsable' => Auth::user()->email,
            'detalles' => 'old: '.json_encode($alergiaOld).', new: '.json_encode($alergia)
        ]);
        
        return redirect()->route('empleado.datos', $id)->with('guardado','ALERGIA ACTUALIZADA');
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
