<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Habito;
use App\Empleado;
use App\Notificacion;
use Carbon\Carbon;
use App\ActivityLog;
use Illuminate\Support\Facades\Auth;

class HabitosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
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

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }

         return view('empleados.cargarHabitos',compact('notificaciones','contadorNotificacion'));
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
          'observacion'=>'required|string|max:50'
        ]);

      $validar = Empleado::where('legajo',$request->legajo_id)->get();

      if ($validar->isNotEmpty()) {
      $guardar= new Habito;

      $guardar->legajo_id=$request->legajo_id;
      $guardar->observacion=$request->observacion;
      $guardar->save();

        unset($guardar['created_at']);
        unset($guardar['updated_at']);

        ActivityLog::create([
            'log' => 'Habitos',
            'descripcion' => 'Created',
            'fecha' => new \DateTime(),
            'responsable' => Auth::user()->email,
            'detalles' => json_encode($guardar)
        ]);

         return redirect()->route('habitos.create')->with(['guardado'=>'Habito guardado con exito']);
      }else{
         return redirect()->route('habitos.create')->with(['error'=>'No existe ese legajo']);
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

        $Habito = Habito::where('id',$request->habitoId)->get();

        foreach ($Habito as $habito) {
            $habitoOld = new Habito();
            $habitoOld->legajo_id = $habito->legajo_id;
            $habitoOld->observacion = $habito->observacion;

            $habito->observacion = $request->observacion; 
        }

        $habito->update();

        unset($habito['created_at']);
        unset($habito['updated_at']);

        ActivityLog::create([
            'log' => 'Habitos',
            'descripcion' => 'Updated',
            'fecha' => new \DateTime(),
            'responsable' => Auth::user()->email,
            'detalles' => 'old: '.json_encode($habitoOld).', new: '.json_encode($habito)
        ]);

        return redirect()->route('empleado.datos', $id)->with('guardado','HABITO ACTUALIZADO');
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
