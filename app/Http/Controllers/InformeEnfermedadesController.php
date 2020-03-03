<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notificacion;
use Carbon\Carbon;
use App\Riesgo;
use App\Empleado;
use App\Enfermedad_Empleado;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Mail;
use App\Area;

class InformeEnfermedadesController extends Controller
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

        $enfermedades=Riesgo::all();



        return view('informes.enfermedades.enfermedades',compact('notificaciones','contadorNotificacion','enfermedades'));
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
       $directivos=Empleado::where('area_trabajo','Gerencia')->where('cargo','Encargado')->get();
        $empleados=Enfermedad_Empleado::all();
        $riesgo=Riesgo::all();


        $contadorBajo=0;
        $contadorMedio=0;
        $contadorAlto=0;
        foreach ($empleados as $enfermedad) {
        	foreach ($riesgo as $rie) {
        		if($rie->enfermedad==$enfermedad->enfermedad && $rie->area==$enfermedad->area_trabajo){
        			if($rie->riesgo>0 && $rie->riesgo<=24){
        				$contadorBajo++;
        			}elseif ($rie->riesgo>24 && $rie->riesgo<=50) {
        				$contadorMedio++;
        			}else{
        				$contadorAlto++;
        			}
        		}
        }
	}

        return view('informes.enfermedades.indexAltoRiesgo',compact('notificaciones','contadorNotificacion','empleados','contadorAlto','contadorBajo','contadorMedio','riesgo','directivos'));    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function enviarPdf(Request $request){
         $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }

        $emplados_enfermedad=Enfermedad_Empleado::all();

        $riesgos=Riesgo::all();
        

       
        $Destinatario=json_decode($request->prueba);

        
        $urlGrafico = $request->hidden_html;
        
        $view =  \View::make('informes.enfermedades.EnviarPdfAltoRiesgo',compact('contadorNotificacion','notificaciones','emplados_enfermedad','riesgos','urlGrafico','Destinatario'))->render();
            $pdf = \App::make('dompdf.wrapper');

            $pdf->loadHtml($view);
            $data = array(
                'name' => 'RioSalEs',
            );

            $email = $Destinatario->email;
            $nombre = $Destinatario->nombre;
            
            Mail::send('emails.sendmail', $data, function($mail) use ($pdf, $email, $nombre){
                $mail->subject('Envio de informe de Riesgos');
                $mail->from('rodrigoacosta1115@gmail.com');
                $mail->to($email, $nombre);
                $mail->attachData($pdf->output(), 'informe-Riesgos.pdf');
            });
        return redirect()->route('informe-enfermedad.create')->with(['guardado' => 'Tu email se envio correctamente.']);
            
    }
    public function verPdf(Request $request){
        $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }

        $emplados_enfermedad=Enfermedad_Empleado::all();

        $riesgos=Riesgo::all();



        

        // $empleadosEnviar=Empleado::where('area_trabajo','Comedor')->where('cargo','director')->get();
        $Destinatario=json_decode($request->prueba);
        
        $urlGrafico = $request->ver_html;
        
        $view =  \View::make('informes.enfermedades.verPdfAltoRiesgo',compact('contadorNotificacion','notificaciones','emplados_enfermedad','urlGrafico','Destinatario','riesgos'))->render();
            $pdf = \App::make('dompdf.wrapper');

            $pdf->loadHtml($view);

            return $pdf->stream();
    }
    public function store(Request $request)
    {
         $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }
        
        $titulo=$request->area;
        $areas=Area::all();
        $areaActual=Enfermedad_Empleado::where('area_trabajo',$request->area)->get();
        $jsonEmpleados=json_decode($areaActual);
        $contadorDeEmpleados=count($jsonEmpleados);
         $arrayEnfermedades=array();
        foreach ($jsonEmpleados as $json) {
            
            array_push($arrayEnfermedades,$json->enfermedad);
        }

      //contar array
        $contar=array();
     
            foreach($arrayEnfermedades as $value)
            {   

                if(isset($contar[$value]))
                {
                    // si ya existe, le añadimos uno
                    
                    $contar[$value]+=1;
                }else{
                    // si no existe lo añadimos al array
                    $contar[$value]=1;
                }
            }
     
     $pruebaArray=array();
     foreach ($arrayEnfermedades as $enfermedad) {
            array_push($pruebaArray,$riesgos=Riesgo::where('enfermedad',$enfermedad)->where('area',$request->area)->get());
     }
       
       $pruena=json_encode($pruebaArray);
       $prueasd=json_decode($pruena);


       $contadorBajo=0;
       $contadorAlto=0;
       $contadorMedio=0;
       foreach ($prueasd as $asd) {
            foreach ($asd as $key) {
                if($key->riesgo>0 && $key->riesgo<=24){
                        $contadorBajo++;
                    }elseif ($key->riesgo>24 && $key->riesgo<=50) {
                        $contadorMedio++;
                    }else{
                        $contadorAlto++;
                    }
            }
       }
       
       $riesgoArea=Riesgo::where('area',$request->area)->get();

       
        



        return view('informes.enfermedades.BusquedaArea',compact('notificaciones','contadorNotificacion','areas','areaActual','titulo','contadorDeEmpleados','contar','arrayEnfermedades','contar','contadorBajo','contadorMedio','contadorAlto','riesgoArea'));

    }
   


    public  function EnfermedadesArea(){
        $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }

        $areas=Area::all();


        return view('informes.enfermedades.VerEnfermedadesPorArea',compact('notificaciones','contadorNotificacion','areas'));

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
        $editarEnfermedad=Riesgo::where('id',$id)->get();
        
        $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;
        

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }

       return view('informes.enfermedades.editarRiesgo',compact('editarEnfermedad','contadorNotificacion','notificaciones'));
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
            'riesgo'=>['required','numeric']
        ]);

        $Riesgo=Riesgo::where('id',$id)->get();

        foreach ($Riesgo as $riesgo) {
            $riesgo->riesgo=$request->riesgo;

        }
        $riesgo->update();
         return redirect()->route('informe-enfermedad.index')->with(['guardado' => 'Actualizado con Exito!!!']);
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
