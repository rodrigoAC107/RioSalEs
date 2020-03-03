<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Notificacion;
use App\Estudio;
use App\Empleado;
use Illuminate\Support\Facades\Storage;
use App\ActivityLog;
use Illuminate\Support\Facades\Auth;

class DocumentacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }

        return view('empleados.documentacion', compact('notificaciones','contadorNotificacion'));
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
        $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $validar = Empleado::where('legajo',$request->legajo_id)->get();
        $contadorNotificacion=0;
         

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }

      
       
     

        if ($validar->isNotEmpty()) {
             $request->validate([
                'legajo_id'=>'required|string|max:12',
                'tipo'=>'required|string|max:50',
                'observacion'=>'required|string|max:50',
                // 'estudio'=>'required|mimes:pdf,jpeg,jpg,png',
                'estudio'=>'required'
        ]);

        $estudio = new Estudio;

        $estudio->legajo_id = $request->legajo_id;
        $estudio->tipo = $request->tipo;
        $estudio->observacion = $request->observacion;
        

        //Subir la imagen
        if($request->estudio == '' || $request->estudio == null){
            
        }else{
        $images_path = $request->estudio;

        $nombre = $request->legajo_id . "-" . $images_path->getClientOriginalName();
    

        // $request->estudio->move(public_path('prueba/'.$request->legajo_id), $nombre);
        $request->estudio->storeAs('prueba', $nombre);
        
        $estudio->nombre = $nombre; 
        
        }

        $estudio->save();

        unset($estudio['created_at']);
        unset($estudio['updated_at']);

        ActivityLog::create([
                'log' => 'Estudio',
                'descripcion' => 'Created',
                'fecha' => new \DateTime(),
                'responsable' => Auth::user()->email,
                'detalles' => json_encode($estudio)
        ]);

        return redirect()->route('documentacion.store', compact('notificaciones','contadorNotificacion'))->with(['guardado' => 'El estudio se guardo correctamente']);
    }else{
         return redirect()->route('documentacion.store', compact('notificaciones','contadorNotificacion'))->with(['error' => 'El legajo no Existe']);
    }

    }

    public function Verdescarga($file){
        return Storage::response("prueba/$file");
    }

    public function descargar($file){
        return Storage::download("prueba/$file");
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
