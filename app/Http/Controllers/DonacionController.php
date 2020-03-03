<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Empleado;
use App\Donacion;
use App\Notificacion;
use Carbon\Carbon;
use Khill\Lavacharts\Lavacharts;
use App\DonacionAnio;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Mail;
use App\ActivityLog;
use Illuminate\Support\Facades\Auth;

class DonacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){   
        $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }

        return view('donacion.index',compact('notificaciones','contadorNotificacion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }

        // ACA EMPIEZA LO DE DONACION
        $donacion = Donacion::where('legajo_id', $request->legajo)->get();
        $legajo = Empleado::where('legajo', $request->legajo)->get();
        $anio = date('Y');

        

        if($legajo->isEmpty()){
            return redirect()->route('donacion.index')->with(['error' => 'Esta persona no esta registrada']);
        }else{
            foreach ($donacion as $dona) {
                if(date('Y') != date('Y',strtotime($dona->updated_at))){
                    $donacionAnio = new DonacionAnio;
                    $donacionAnio->legajo_id = $dona->legajo_id;
                    $donacionAnio->fecha_1 = $dona->fecha_1;
                    $donacionAnio->fecha_2 = $dona->fecha_2;
                    $donacionAnio->fecha_3 = $dona->fecha_3;
                    $donacionAnio->total = $dona->total;

                    $donacionAnio->save();

                    $dona->delete();

                    return view('donacion.tablaDonacion', compact('notificaciones','contadorNotificacion', 'legajo', 'donacion'));
                }   

                 if ($dona->total == 3) {
                    return redirect()->route('donacion.index')->with(['error' => 'Esta persona ya realizo las 3 donaciones correspondientes']);
                }
            }
              return view('donacion.tablaDonacion', compact('notificaciones','contadorNotificacion', 'legajo', 'donacion'));
        }      

       
    }

    public function update(Request $request, $id){

    if($request->numeroDonacion == 'Primera'){   

        Donacion::updateOrCreate([
                'legajo_id' => $id
            ],[
                'legajo_id' => $id,
                'fecha_1' => date('Y-m-d H:m:s'),
                'fecha_2' => NULL,
                'fecha_3' => NULL,
                'total' => '1',
                'created_at' => date('Y-m-d H:m:s')
            ]);
            
            $primera = Donacion::where('legajo_id', $id)->get();

            ActivityLog::create([
                'log' => 'Donacion',
                'descripcion' => 'Created',
                'fecha' => new \DateTime(),
                'responsable' => Auth::user()->email,
                'detalles' => json_encode($primera)
            ]);


            return redirect()->route('donacion.index')->with(['guardado' => 'Actualizacion de la primera fecha']);

    }else if($request->numeroDonacion == 'Segunda'){
        $segunda = Donacion::where('legajo_id', $id)->get();
            foreach ($segunda as $seg) {
            Donacion::updateOrCreate([
                    'legajo_id' => $id
                ],[
                    'legajo_id' => $id,
                    'fecha_1' => $seg->fecha_1,
                    'fecha_2' => date('Y-m-d H:m:s'),
                    'fecha_3' => NULL,
                    'total' => '2',
                    'updated_at' => date('Y-m-d H:m:s')
                ]);

                ActivityLog::create([
                    'log' => 'Donacion',
                    'descripcion' => 'Updated',
                    'fecha' => new \DateTime(),
                    'responsable' => Auth::user()->email,
                    'detalles' => json_encode($segunda)
                ]);

                return redirect()->route('donacion.index')->with(['guardado' => 'Actualizacion de la segunda fecha']);
            }
    }else if($request->numeroDonacion == 'Tercera'){
        $tercera = Donacion::where('legajo_id', $id)->get();
            foreach ($tercera as $ter) {
            Donacion::updateOrCreate([
                    'legajo_id' => $id
                ],[
                    'legajo_id' => $id,
                    'fecha_1' => $ter->fecha_1,
                    'fecha_2' => $ter->fecha_2,
                    'fecha_3' => date('Y-m-d H:m:s'),
                    'total' => '3',
                    'updated_at' => date('Y-m-d H:m:s')
                ]);

                ActivityLog::create([
                    'log' => 'Donacion',
                    'descripcion' => 'Updated',
                    'fecha' => new \DateTime(),
                    'responsable' => Auth::user()->email,
                    'detalles' => json_encode($tercera)
                ]);

                $nombreEnvio = Empleado::where('area_trabajo', 'RR HH')
                                        ->where('cargo', 'Encargado')
                                        ->get();
                $nombreEmpleado = Empleado::where('legajo', $id)->get();

                foreach ($nombreEnvio as $envio) {
                    $email = $envio->email;
                    $nombre = $envio->nombre;
                    $apellido = $envio->apellido;
                    $cargo = $envio->cargo;
                    $area_trabajo = $envio->area_trabajo;
                }
                
                $view =  \View::make('informes.donacion.informeTerceraDonacion', compact('nombreEmpleado', 'nombre', 'apellido', 'cargo', 'area_trabajo'))->render();

                $pdf = \App::make('dompdf.wrapper');

                $pdf->loadHtml($view);
                
                $data = array(
                    'name' => 'RioSalEs',
                );
                
                Mail::send('emails.sendmail', $data, function($mail) use ($pdf, $email, $nombre){
                    $mail->subject('Envio de informe sobre tercera donacion anual');
                    $mail->from('rodrigoacosta1115@gmail.com');
                    $mail->to($email, $nombre);
                    $mail->attachData($pdf->output(), 'informe-tercera-donacion.pdf');
                });
                    return redirect()->route('donacion.index')->with(['guardado' => 'Actualizacion de la tercera fecha y envio de informe de tercera donacion']);
                }
        } else if ($request->numeroDonacion == '') {
            return redirect()->route('donacion.index')->with(['error' => 'Seleccione la donación']);
        }
        else{
                return redirect()->route('donacion.index')->with(['error' => 'Ya se realizaron las 3 donaciones por este año']);
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
