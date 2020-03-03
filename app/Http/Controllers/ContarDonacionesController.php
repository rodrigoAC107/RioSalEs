<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notificacion;
use Carbon\Carbon;
use App\Empleado;
use App\Donacion;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Mail;

class ContarDonacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enero = 0;
        $febrero = 0;
        $marzo = 0;
        $abril = 0;
        $mayo = 0;
        $junio = 0;
        $julio = 0;
        $agosto = 0;
        $septiembre = 0;
        $octubre = 0;
        $noviembre = 0;
        $diciembre = 0;

        $fecha1 = 0;
        $fecha2 = 0;
        $fecha3 = 0;

        
        $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }

        $donaciones = Donacion::all();
        $empleadosDirectivos = Empleado::where('cargo', 'Encargado')->get();

        foreach($donaciones as $donacion){

            if($donacion->fecha_1){
                $fecha1 = Carbon::parse($donacion->fecha_1)->format('F');
                if($fecha1 == 'January'){
                    $enero++;
                }elseif ($fecha1 == 'February') {
                    $febrero++;
                }elseif ($fecha1 == 'March') {
                    $marzo++;
                }elseif ($fecha1 == 'April') {
                    $abril++;
                }elseif ($fecha1 == 'May') {
                    $mayo++;
                }elseif ($fecha1 == 'June') {
                    $junio++;
                }elseif ($fecha1 == 'July') {
                    $julio++;
                }elseif ($fecha1 == 'August') {
                    $agosto++;
                }elseif ($fecha1 == 'September') {
                    $septiembre++;
                }elseif ($fecha1 == 'October') {
                    $octubre++;
                }elseif ($fecha1 == 'November') {
                    $noviembre++;
                }elseif ($fecha1 == 'December') {
                    $diciembre++;
                }
            }

            if($donacion->fecha_2){
                $fecha2 = Carbon::parse($donacion->fecha_2)->format('F');
                if($fecha2 == 'January'){
                    $enero++;
                }elseif ($fecha2 == 'February') {
                    $febrero++;
                }elseif ($fecha2 == 'March') {
                    $marzo++;
                }elseif ($fecha2 == 'April') {
                    $abril++;
                }elseif ($fecha2 == 'May') {
                    $mayo++;
                }elseif ($fecha2 == 'June') {
                    $junio++;
                }elseif ($fecha2 == 'July') {
                    $julio++;
                }elseif ($fecha2 == 'August') {
                    $agosto++;
                }elseif ($fecha2 == 'September') {
                    $septiembre++;
                }elseif ($fecha2 == 'October') {
                    $octubre++;
                }elseif ($fecha2 == 'November') {
                    $noviembre++;
                }elseif ($fecha2 == 'December') {
                    $diciembre++;
                }
            }
            
            if($donacion->fecha_3){
                $fecha3 = Carbon::parse($donacion->fecha_3)->format('F');
                if($fecha3 === 'January'){
                    $enero++;
                }elseif ($fecha3 === 'February') {
                    $febrero++;
                }elseif ($fecha3 === 'March') {
                    $marzo++;
                }elseif ($fecha3 === 'April') {
                    $abril++;
                }elseif ($fecha3 === 'May') {
                    $mayo++;
                }elseif ($fecha3 === 'June') {
                    $junio++;
                }elseif ($fecha3 === 'July') {
                    $julio++;
                }elseif ($fecha3 === 'August') {
                    $agosto++;
                }elseif ($fecha3 === 'September') {
                    $septiembre++;
                }elseif ($fecha3 === 'October') {
                    $octubre++;
                }elseif ($fecha3 === 'November') {
                    $noviembre++;
                }elseif ($fecha3 === 'December') {
                    $diciembre++;
                }
            }
                       
        }     

        return view('informes.contar_donaciones.index',compact('notificaciones','contadorNotificacion','donaciones', 'enero', 'febrero','marzo','abril','mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre', 'empleadosDirectivos'));
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

        $donaciones = Donacion::all();

        return view('informes.contar_donaciones.tablaDonaciones', compact('notificaciones', 'contadorNotificacion', 'donaciones'));
    }

    public function envioPDF(Request $request)
    {
        $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }

        $enero = 0;
        $febrero = 0;
        $marzo = 0;
        $abril = 0;
        $mayo = 0;
        $junio = 0;
        $julio = 0;
        $agosto = 0;
        $septiembre = 0;
        $octubre = 0;
        $noviembre = 0;
        $diciembre = 0;

        $empleados = Empleado::all();

        if ($request->nombreArea) {
            $nombreEnvio = $request->nombreArea;
            
        }else{
            return redirect()->route('contar-donaciones.index')->with(['error' => 'No seleccionó destinatario']);
        }

        $donaciones = Donacion::all();
        
        foreach($donaciones as $donacion){

            $fecha1 = date("F", strtotime($donacion->fecha_1));
            $fecha2 = date("F", strtotime($donacion->fecha_2));
            $fecha3 = date("F", strtotime($donacion->fecha_3));

            if($fecha1 == 'January'){
                $enero++;
            }elseif ($fecha1 == 'February') {
                $febrero++;
            }elseif ($fecha1 == 'March') {
                $marzo++;
            }elseif ($fecha1 == 'April') {
                $abril++;
            }elseif ($fecha1 == 'May') {
                $mayo++;
            }elseif ($fecha1 == 'June') {
                $junio++;
            }elseif ($fecha1 == 'July') {
                $julio++;
            }elseif ($fecha1 == 'August') {
                $agosto++;
            }elseif ($fecha1 == 'September') {
                $septiembre++;
            }elseif ($fecha1 == 'October') {
                $octubre++;
            }elseif ($fecha1 == 'November') {
                $noviembre++;
            }elseif ($fecha1 == 'December') {
                $diciembre++;
            }

            if($fecha2 == 'January'){
                $enero++;
            }elseif ($fecha2 == 'February') {
                $febrero++;
            }elseif ($fecha2 == 'March') {
                $marzo++;
            }elseif ($fecha2 == 'April') {
                $abril++;
            }elseif ($fecha2 == 'May') {
                $mayo++;
            }elseif ($fecha2 == 'June') {
                $junio++;
            }elseif ($fecha2 == 'July') {
                $julio++;
            }elseif ($fecha2 == 'August') {
                $agosto++;
            }elseif ($fecha2 == 'September') {
                $septiembre++;
            }elseif ($fecha2 == 'October') {
                $octubre++;
            }elseif ($fecha2 == 'November') {
                $noviembre++;
            }elseif ($fecha2 == 'December') {
                $diciembre++;
            }

            if($fecha3 == 'January'){
                $enero++;
            }elseif ($fecha3 == 'February') {
                $febrero++;
            }elseif ($fecha3 == 'March') {
                $marzo++;
            }elseif ($fecha3 == 'April') {
                $abril++;
            }elseif ($fecha3 == 'May') {
                $mayo++;
            }elseif ($fecha3 == 'June') {
                $junio++;
            }elseif ($fecha3 == 'July') {
                $julio++;
            }elseif ($fecha3 == 'August') {
                $agosto++;
            }elseif ($fecha3 == 'September') {
                $septiembre++;
            }elseif ($fecha3 == 'October') {
                $octubre++;
            }elseif ($fecha3 == 'November') {
                $noviembre++;
            }elseif ($fecha3 == 'December') {
                $diciembre++;
            }
        }

            $urlGrafico = $request->hidden_html;

            $view =  \View::make('informes.contar_donaciones.contarDonacionesPdf', compact('notificaciones','contadorNotificacion','donaciones', 'enero', 'febrero','marzo','abril','mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre', 'nombreEnvio', 'urlGrafico'))->render();

            $pdf = \App::make('dompdf.wrapper');

            $pdf->loadHtml($view);
            
            $data = array(
                'name' => 'RioSalEs',
            );

            $email = json_decode($nombreEnvio)->email;
            $nombre = json_decode($nombreEnvio)->nombre;
            
            Mail::send('emails.sendmail', $data, function($mail) use ($pdf, $email, $nombre){
                $mail->subject('Envio de informe sobre cantidades de donaciones');
                $mail->from('rodrigoacosta1115@gmail.com');
                $mail->to($email, $nombre);
                $mail->attachData($pdf->output(), 'informe-donacion.pdf');
            });

            return redirect()->route('contar-donaciones.index')->with(['guardado' => 'Tu email se envio correctamente.']);


    } // Fin de envioPDF

    public function verPdf(Request $request){

        $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }

        $enero = 0;
        $febrero = 0;
        $marzo = 0;
        $abril = 0;
        $mayo = 0;
        $junio = 0;
        $julio = 0;
        $agosto = 0;
        $septiembre = 0;
        $octubre = 0;
        $noviembre = 0;
        $diciembre = 0;

        $donaciones = Donacion::all();
        
        foreach($donaciones as $donacion){

            $fecha1 = date("F", strtotime($donacion->fecha_1));
            $fecha2 = date("F", strtotime($donacion->fecha_2));
            $fecha3 = date("F", strtotime($donacion->fecha_3));

            if($fecha1 == 'January'){
                $enero++;
            }elseif ($fecha1 == 'February') {
                $febrero++;
            }elseif ($fecha1 == 'March') {
                $marzo++;
            }elseif ($fecha1 == 'April') {
                $abril++;
            }elseif ($fecha1 == 'May') {
                $mayo++;
            }elseif ($fecha1 == 'June') {
                $junio++;
            }elseif ($fecha1 == 'July') {
                $julio++;
            }elseif ($fecha1 == 'August') {
                $agosto++;
            }elseif ($fecha1 == 'September') {
                $septiembre++;
            }elseif ($fecha1 == 'October') {
                $octubre++;
            }elseif ($fecha1 == 'November') {
                $noviembre++;
            }elseif ($fecha1 == 'December') {
                $diciembre++;
            }

            if($fecha2 == 'January'){
                $enero++;
            }elseif ($fecha2 == 'February') {
                $febrero++;
            }elseif ($fecha2 == 'March') {
                $marzo++;
            }elseif ($fecha2 == 'April') {
                $abril++;
            }elseif ($fecha2 == 'May') {
                $mayo++;
            }elseif ($fecha2 == 'June') {
                $junio++;
            }elseif ($fecha2 == 'July') {
                $julio++;
            }elseif ($fecha2 == 'August') {
                $agosto++;
            }elseif ($fecha2 == 'September') {
                $septiembre++;
            }elseif ($fecha2 == 'October') {
                $octubre++;
            }elseif ($fecha2 == 'November') {
                $noviembre++;
            }elseif ($fecha2 == 'December') {
                $diciembre++;
            }

            if($fecha3 == 'January'){
                $enero++;
            }elseif ($fecha3 == 'February') {
                $febrero++;
            }elseif ($fecha3 == 'March') {
                $marzo++;
            }elseif ($fecha3 == 'April') {
                $abril++;
            }elseif ($fecha3 == 'May') {
                $mayo++;
            }elseif ($fecha3 == 'June') {
                $junio++;
            }elseif ($fecha3 == 'July') {
                $julio++;
            }elseif ($fecha3 == 'August') {
                $agosto++;
            }elseif ($fecha3 == 'September') {
                $septiembre++;
            }elseif ($fecha3 == 'October') {
                $octubre++;
            }elseif ($fecha3 == 'November') {
                $noviembre++;
            }elseif ($fecha3 == 'December') {
                $diciembre++;
            }
        }
            $Destinatario=json_decode($request->prueba);

            $urlGrafico = $request->ver_html;

            $view =  \View::make('informes.contar_donaciones.verPdf', compact('notificaciones','contadorNotificacion','donaciones', 'enero', 'febrero','marzo','abril','mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre', 'urlGrafico','Destinatario'))->render();
            $pdf = \App::make('dompdf.wrapper');

            $pdf->loadHtml($view);

            return $pdf->stream();
    } // fin de ver pdf

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
