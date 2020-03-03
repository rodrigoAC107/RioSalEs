<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notificacion;
use Carbon\Carbon;
use App\Empleado;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Mail;

class InformeDonacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(){
        $oNegativo = 0;
        $oPositivo = 0;
        $ABNegativo = 0;
        $ABPositivo = 0;
        $ANegativo = 0;
        $APositivo = 0;
        $BNegativo = 0;
        $BPositivo = 0;

        $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }

        $empleado = Empleado::all();
        $empleadosDirectivos = Empleado::where('cargo', 'Encargado')->get();

        
        foreach ($empleado as $Empleado) {
            if($Empleado->grupo_sanguineo == 'O-'){
                $oNegativo++;
            }elseif($Empleado->grupo_sanguineo == 'O+'){
                $oPositivo++;
            }elseif($Empleado->grupo_sanguineo == 'AB-'){
                $ABNegativo++;
            }elseif($Empleado->grupo_sanguineo == 'AB+'){
                $ABPositivo++;
            }elseif($Empleado->grupo_sanguineo == 'A-'){
                $ANegativo++;
            }elseif($Empleado->grupo_sanguineo == 'A+'){
                $APositivo++;
            }elseif($Empleado->grupo_sanguineo == 'B-'){
                $BNegativo++;
            }elseif($Empleado->grupo_sanguineo == 'B+'){
                $BPositivo++;
            }

        }

       


        return view('informes.donacion.InformeDonacion', compact('notificaciones','contadorNotificacion','empleado','oNegativo','oPositivo','ABNegativo','ABPositivo','ANegativo','APositivo','BNegativo','BPositivo', 'empleadosDirectivos'));

    } // Fin de index

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

        $empleados = Empleado::all();

        return view('informes.donacion.tablaEmpleados', compact('notificaciones', 'contadorNotificacion', 'empleados'));

    } // Fin de create

    public function envioPDF(Request $request)
    {
        $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }

        $oNegativo = 0;
        $oPositivo = 0;
        $ABNegativo = 0;
        $ABPositivo = 0;
        $ANegativo = 0;
        $APositivo = 0;
        $BNegativo = 0;
        $BPositivo = 0;

        $empleados = Empleado::all();

        if ($request->nombreArea) {
            $nombreEnvio = $request->nombreArea;
            
        }else{
            return redirect()->route('informe-donacion.index')->with(['error' => 'No seleccionó destinatario']);
        }

        
        foreach ($empleados as $Empleado) {
            if($Empleado->grupo_sanguineo == 'O-'){
                $oNegativo++;
            }elseif($Empleado->grupo_sanguineo == 'O+'){
                $oPositivo++;
            }elseif($Empleado->grupo_sanguineo == 'AB-'){
                $ABNegativo++;
            }elseif($Empleado->grupo_sanguineo == 'AB+'){
                $ABPositivo++;
            }elseif($Empleado->grupo_sanguineo == 'A-'){
                $ANegativo++;
            }elseif($Empleado->grupo_sanguineo == 'A+'){
                $APositivo++;
            }elseif($Empleado->grupo_sanguineo == 'B-'){
                $BNegativo++;
            }elseif($Empleado->grupo_sanguineo == 'B+'){
                $BPositivo++;
            }

        }

            $urlGrafico = $request->hidden_html;


            $view =  \View::make('informes.donacion.pdfDonacion', compact('notificaciones','contadorNotificacion','empleados','oNegativo','oPositivo','ABNegativo','ABPositivo','ANegativo','APositivo','BNegativo','BPositivo', 'urlGrafico', 'nombreEnvio'))->render();
            $pdf = \App::make('dompdf.wrapper');

            $pdf->loadHtml($view);
            
            $data = array(
                'name' => 'RioSalEs',
            );

            $email = json_decode($nombreEnvio)->email;
            $nombre = json_decode($nombreEnvio)->nombre;
            
            Mail::send('emails.sendmail', $data, function($mail) use ($pdf, $email, $nombre){
                $mail->subject('Envio de informe sobre grupo sanguineos');
                $mail->from('rodrigoacosta1115@gmail.com');
                $mail->to($email, $nombre);
                $mail->attachData($pdf->output(), 'informe-grupo-sanguineo.pdf');
            });
        

            return redirect()->route('informe-donacion.index')->with(['guardado' => 'Tu email se envio correctamente.']);


    } // Fin de envioPDF

    public function verPdf(Request $request){


        // dd($request->prueba);

        $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }

        $oNegativo = 0;
        $oPositivo = 0;
        $ABNegativo = 0;
        $ABPositivo = 0;
        $ANegativo = 0;
        $APositivo = 0;
        $BNegativo = 0;
        $BPositivo = 0;

        $empleados = Empleado::all();

        $urlGrafico = $request->ver_html;

        
        foreach ($empleados as $Empleado) {
            if($Empleado->grupo_sanguineo == 'O-'){
                $oNegativo++;
            }elseif($Empleado->grupo_sanguineo == 'O+'){
                $oPositivo++;
            }elseif($Empleado->grupo_sanguineo == 'AB-'){
                $ABNegativo++;
            }elseif($Empleado->grupo_sanguineo == 'AB+'){
                $ABPositivo++;
            }elseif($Empleado->grupo_sanguineo == 'A-'){
                $ANegativo++;
            }elseif($Empleado->grupo_sanguineo == 'A+'){
                $APositivo++;
            }elseif($Empleado->grupo_sanguineo == 'B-'){
                $BNegativo++;
            }elseif($Empleado->grupo_sanguineo == 'B+'){
                $BPositivo++;
            }

        }   
        $Destinatario=json_decode($request->prueba);
     


        
        
   

            $view =  \View::make('informes.donacion.verPdf', compact('notificaciones','contadorNotificacion','empleados','oNegativo','oPositivo','ABNegativo','ABPositivo','ANegativo','APositivo','BNegativo','BPositivo', 'urlGrafico','Destinatario'))->render();
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
