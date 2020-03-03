<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notificacion;
use Carbon\Carbon;
use App\Empleado;
use App\Dieta;
use App\Comidas_dietas;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Mail;
class InformeDietasController extends Controller
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

        $empleados=Dieta::all();
        $contadorGeneral=0;
        $contadorVegetariano=0;
        $contadorHipo=0;
        $contadorDiabe=0;
        $contadorCelia=0;
        foreach ($empleados as $empleado) {
            
                 if ($empleado->tipo_1=='General' || $empleado->tipo_2=='General') {
                $contadorGeneral++;
                }
                if ($empleado->tipo_1=='Vegetariano' || $empleado->tipo_2=='Vegetariano') {
                $contadorVegetariano++;   
                }
                if ($empleado->tipo_1=='Hipo Sodica' || $empleado->tipo_2=='Hipo Sodica') {
                $contadorHipo++;   
                }
                if ($empleado->tipo_1=='Diabéticios' || $empleado->tipo_2=='Diabéticios') {
                $contadorDiabe++;   
                }
                if ($empleado->tipo_1=='Celiacos' || $empleado->tipo_2=='Celiacos') {
                $contadorCelia++;   
                }
            
        }

        $empleadosEnviar=Empleado::where('area_trabajo','Comedor')->where('cargo','Encargado')->get();

    

        return view('informes.dietas.informeDietas',compact('contadorNotificacion','notificaciones','empleados','empleadosEnviar','contadorGeneral','contadorVegetariano','contadorCelia','contadorDiabe','contadorHipo'));
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


        $empleados=Empleado::all();


        return view('informes.dietas.mostrarEmpleadosDietas',compact('contadorNotificacion','notificaciones','empleados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dietasEspecificas()
    {
        $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }

        $empleados=Empleado::all();


        return view('informes.dietas.dietasEspecificas',compact('contadorNotificacion','notificaciones','empleados'));
    }

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
        $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }
        $empleadoDieta=Dieta::where('legajo_id',$id)->get();
        $dietas=Comidas_dietas::all();
        return view('informes.dietas.editarDietaEmpleado',compact('contadorNotificacion','notificaciones','empleadoDieta','dietas'));
    }

    public function verPdf(Request $request){
         $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }

        $empleados=Empleado::all();
        

        $empleadosEnviar=Empleado::where('area_trabajo','Comedor')->where('cargo','Encargado')->get();
        $Destinatario=json_decode($request->prueba);
        
        $urlGrafico = $request->ver_html;
        
        $view =  \View::make('informes.dietas.verPdf',compact('contadorNotificacion','notificaciones','empleados','empleadosEnviar','urlGrafico','Destinatario'))->render();
            $pdf = \App::make('dompdf.wrapper');

            $pdf->loadHtml($view);

            return $pdf->stream();
    }
    public function enviarPdf(Request $request){
         $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }

        $empleados=Empleado::all();
        

        $empleadosEnviar=Empleado::where('area_trabajo','Comedor')->where('cargo','Encargado')->get();
        $Destinatario=json_decode($request->prueba);
        
        $urlGrafico = $request->hidden_html;
        
        $view =  \View::make('informes.dietas.pdfDietas',compact('contadorNotificacion','notificaciones','empleados','empleadosEnviar','urlGrafico','Destinatario'))->render();
            $pdf = \App::make('dompdf.wrapper');

            $pdf->loadHtml($view);
            $data = array(
                'name' => 'RioSalEs',
            );

            $email = $Destinatario->email;
            $nombre = $Destinatario->nombre;
            
            Mail::send('emails.sendmail', $data, function($mail) use ($pdf, $email, $nombre){
                $mail->subject('Envio de informe sobre dietas alimenticias');
                $mail->from('rodrigoacosta1115@gmail.com');
                $mail->to($email, $nombre);
                $mail->attachData($pdf->output(), 'informe-dietas.pdf');
            });
        return redirect()->route('informe-dietas.index')->with(['guardado' => 'Tu email se envio correctamente.']);
            
    }

    public function enviarPdfDietasEspecificas($id){
        $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }
        $Destinatario=Empleado::where('area_trabajo','Comedor')->where('cargo','Encargado')->take(1)->get();

        $email;
        $nombre;
        foreach ($Destinatario as $empleado) {
            $nombre=$empleado->nombre;
            $email=$empleado->email;
        }

        $Dietas=Dieta::where('legajo_id',$id)->get();

        $view =  \View::make('informes.dietas.enviarPdfDietasParticulares',compact('contadorNotificacion','notificaciones','Destinatario','Dietas'))->render();
            $pdf = \App::make('dompdf.wrapper');

            $pdf->loadHtml($view);
            $data = array(
                'name' => 'RioSalEs',
            );

            
            
            Mail::send('emails.sendmail', $data, function($mail) use ($pdf, $email, $nombre){
                $mail->subject('Envio de informe sobre dietas alimenticias del empleado:');
                $mail->from('rodrigoacosta1115@gmail.com');
                $mail->to($email, $nombre);
                $mail->attachData($pdf->output(), 'informe-dietas-particular.pdf');
            });
        return redirect()->route('informe-dietas.dietasEspecificas')->with(['guardado' => 'Tu email se envio correctamente.']);

    }


    public function verPdfDietasEspecificas($id){

        $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }

         $Destinatario=Empleado::where('area_trabajo','Comedor')->where('cargo','Encargado')->take(1)->get();



         $Dietas=Dieta::where('legajo_id',$id)->get();


        
        $view =  \View::make('informes.dietas.pdfDietasParticulares',compact('contadorNotificacion','notificaciones','Dietas','Destinatario'))->render();
        $pdf = \App::make('dompdf.wrapper');

        $pdf->loadHtml($view);

        return $pdf->stream();


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
        
    }

    public function editarDieta(Request $request){
        $empleadoDieta=Dieta::where('legajo_id',$request->legajo_id)->get();

        // dd($empleadoDieta);
        foreach ($empleadoDieta as $empleado) {
            
                $empleado->legajo_id=$request->legajo_id;
                $empleado->tipo_1=$request->tipo_1;
                $empleado->tipo_2=$request->tipo_2;
                $empleado->comidas_permitidas=$request->comidas_permitidas;
                $empleado->comidas_no_permitidas=$request->comidas_no_permitidas;
                
          
             
               
            
            $empleado->update();
        }


        return redirect()->route('informe-dietas.dietasEspecificas')->with(['guardado' => 'Dieta Modificada con Exito!!!']);
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
