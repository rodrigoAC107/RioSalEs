<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Empleado;
use App\Dieta;
use App\Alergia;
use App\AntecedentesFamiliares;
use App\AntecedentesEmpleado;
use App\Imc;
use App\Vacuna;
use App\Area;
use App\Carnet_Vacuna;
use App\Control_Vacuna;
use App\Donacion;
use App\Habito;
use App\Estudio;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Notificacion;
use App\DonacionAnio;
use App\ActivityLog;
use Illuminate\Support\Facades\Auth;


class EmpleadoController extends Controller
{
    public function index(){
      $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }

    	return view('empleados.index',compact('notificaciones','contadorNotificacion'));
    }
    public function buscar(Request $request){
    	$empleados=Empleado::all();
      $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }


    	return view('empleados.buscar',compact('empleados','notificaciones','contadorNotificacion'));
    }

    public function edit($id){

      $editarEmpleado = Empleado::where('legajo', $id)->get();
       $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;
        $areas=Area::all();

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }


      return view('empleados.editarEmpleados', compact('editarEmpleado','notificaciones','contadorNotificacion','areas'));
    }

    public function update(Request $request, $legajo)
    {   
        $request->validate([

        'legajo'=>'required|max:12',
        'nombre'=>'required|alpha|max:50',
        'apellido'=>'required|alpha|max:50',
        'area_trabajo'=>'required|string|max:100',
        'cargo'=>'required|string|max:50',
        'fecha_nacimiento'=>'required|date|max:200',
        'cuil'=>'required|numeric',
        'edad'=>'required|numeric',
        'anteojos'=>'required|string',
        'sexo'=>'required|string|max:50',
        'nacionalidad'=>'required|string|max:50',
        'fecha_alta'=>'required|date|max:20',
        'estado_civil'=>'required|string|max:20',
        'grupo_sanguineo'=>'required|string|max:10',
        'telefono'=>'required|numeric',
        // 'estatura'=>'required|numeric|max:5',
        // 'peso'=>'required|numeric|max:5',
        'email'=>'required|string|max:100',
        'domicilio'=>'required|string|max:200'
      ]);

      //Subir la imagen
        if($request->imagen == '' || $request->imagen == null){
            
        }else{
        
        $images_path = $request->imagen;
        $binary_data = base64_decode($images_path);

        $nombre = $request->legajo.".jpg";

        Storage::disk('public')->put($nombre, $binary_data);

        $request->imagen = $nombre; 
        
        }

        $Empleado = Empleado::where('legajo', $legajo)->get();

        foreach ($Empleado as $empleado) {

          $empleadoOld = new Empleado;

          $empleadoOld->nombre = $empleado->nombre;
          $empleadoOld->apellido = $empleado->apellido;
          $empleado->area_trabajo = $empleado->area_trabajo;
          $empleadoOld->cargo = $empleado->cargo;
          $empleadoOld->fecha_nacimiento = $empleado->fecha_nacimiento;
          $empleadoOld->cuil = $empleado->cuil;
          $empleadoOld->edad = $empleado->edad;
          $empleadoOld->anteojos = $empleado->anteojos;
          $empleadoOld->sexo = $empleado->sexo;
          $empleadoOld->nacionalidad = $empleado->nacionalidad;
          $empleadoOld->fecha_alta = $empleado->fecha_alta;
          $empleadoOld->estado_civil = $empleado->estado_civil;
          $empleadoOld->grupo_sanguineo = $empleado->grupo_sanguineo;
          $empleadoOld->telefono = $empleado->telefono;
          $empleadoOld->email = $empleado->email;
          $empleadoOld->domicilio = $empleado->domicilio;
          $empleadoOld->imagen = $empleado->imagen;

        }


        Empleado::where('legajo', $legajo)->update([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'area_trabajo' => $request->area_trabajo,
            'cargo'=>$request->cargo,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'cuil' => $request->cuil,
            'edad' => $request->edad,
            'anteojos' => $request->anteojos,
            'sexo' => $request->sexo,
            'nacionalidad' => $request->nacionalidad,
            'fecha_alta' => $request->fecha_alta,
            'estado_civil' => $request->estado_civil,
            'grupo_sanguineo' => $request->grupo_sanguineo,
            'telefono' => $request->telefono, 
            'email' => $request->email,
            'domicilio' => $request->domicilio,
            'imagen' => $request->imagen
            ]);

            unset($empleado['created_at']);
            unset($empleado['updated_at']);
    
            ActivityLog::create([
                'log' => 'Empleado',
                'descripcion' => 'Updated',
                'fecha' => new \DateTime(),
                'responsable' => Auth::user()->email,
                'detalles' => 'old: '.json_encode($empleadoOld).', new: '.json_encode($empleado)
            ]);


        return redirect()->route('empleado.buscar')->with('guardado','ACTUALIZACION CORRECTA');
    }

   public function delete($legajo){

      Alergia::where('legajo_id',$legajo)->delete();
      Dieta::where('legajo_id',$legajo)->delete();
      AntecedentesEmpleado::where('legajo_id',$legajo)->delete();
      AntecedentesFamiliares::where('legajo_id',$legajo)->delete();
      Imc::where('legajo_id',$legajo)->delete();
      Control_Vacuna::where('legajo_id', $legajo)->delete();
      Vacuna::where('legajo_id', $legajo)->delete();
      Donacion::where('legajo_id',$legajo)->delete();
      Empleado::where('legajo',$legajo)->delete();

      return redirect()->route('empleado.buscar')->with('guardado','SE ELIMINO EL REGISTRO');
   }

    public function informacion(){

      $areas=Area::all();
      $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }

    	return view('empleados.informacion',compact('areas','notificaciones','contadorNotificacion'));
    }
   

   public function guardar(Request $request){

   		$request->validate([

   			'legajo'=>'required|unique:empleados,legajo|max:12',
   			'nombre'=>'required|alpha|max:50',
   			'apellido'=>'required|alpha|max:50',
   			'area_trabajo'=>'required|string|max:100',
        'cargo'=>'required|string|max:50',
   			'fecha_nacimiento'=>'required|date|max:200',
   			'cuil'=>'required|numeric',
   			'edad'=>'required|numeric',
   			'anteojos'=>'required|string',
   			'sexo'=>'required|string|max:50',
   			'nacionalidad'=>'required|string|max:50',
   			'fecha_alta'=>'required|date|max:20',
   			'estado_civil'=>'required|string|max:20',
   			'grupo_sanguineo'=>'required|string|max:10',
   			'telefono'=>'required|numeric',
   			'estatura'=>'required|numeric',
   			'peso'=>'required|numeric',
   			'email'=>'required|string|max:100',
   			'domicilio'=>'required|string|max:200'
   		]);

   		$guardar= new Empleado;

   		$guardar->legajo=$request->legajo;
   		$guardar->nombre=$request->nombre;
   		$guardar->apellido=$request->apellido;
   		$guardar->area_trabajo=$request->area_trabajo;
      $guardar->cargo=$request->cargo;
   		$guardar->fecha_nacimiento=$request->fecha_nacimiento;
   		$guardar->cuil=$request->cuil;
   		$guardar->edad=$request->edad;
   		$guardar->anteojos=$request->anteojos;
   		$guardar->sexo=$request->sexo;
   		$guardar->nacionalidad=$request->nacionalidad;
   		$guardar->fecha_alta=$request->fecha_alta;
   		$guardar->estado_civil=$request->estado_civil;
   		$guardar->grupo_sanguineo=$request->grupo_sanguineo;
   		$guardar->telefono=$request->telefono;
   		$guardar->email=$request->email;
   		$guardar->domicilio=$request->domicilio;

       //Subir la imagen
        if($request->imagen == '' || $request->imagen == null){
            
        }else{
        
          $images_path = $request->imagen;
          $binary_data = base64_decode($images_path);

          $nombre = $request->legajo.".jpg";

          Storage::disk('public')->put($nombre, $binary_data);

          $guardar->imagen = $nombre; 
        
        }



       $guardar->save();
       
        unset($guardar['created_at']);
        unset($guardar['updated_at']);

        ActivityLog::create([
            'log' => 'Empleado',
            'descripcion' => 'Created',
            'fecha' => new \DateTime(),
            'responsable' => Auth::user()->email,
            'detalles' => json_encode($guardar)
        ]);


      //Cargar en tabla de imc
      $guardar2=new Imc;
      $guardar2->legajo_id=$request->legajo;
      $guardar2->estatura=$request->estatura;
      $guardar2->peso=$request->peso;
      
      //calculo del imc para los empleados cuando los cargamos
      $calculo1=($guardar2->estatura/100)*($guardar2->estatura/100);
      settype($calculo1, "float");
      $calculo2=$guardar2->peso/$calculo1;
      settype($calculo2, "float");
      $guardar2->calculo_imc=$calculo2;

      //determinacion del estado del empleado
      if ($calculo2<18.5) {
          $guardar2->estado="Bajo Peso";
      }elseif ($calculo2>=18.5 && $calculo2<=24.9) {
          $guardar2->estado="Peso Normal";
      }elseif ($calculo2==25) {
          $guardar2->estado="Sobrepeso";
      }elseif ($calculo2>25 && $calculo2<=29.9) {
          $guardar2->estado="Preobesidad";
      }elseif ($calculo2>=30 && $calculo2<=34.9) {
          $guardar2->estado="Obesidad Clase 1";
      }elseif($calculo2>=35 && $calculo2<=39.9){
          $guardar2->estado="Obesidad Clase 2";
      }elseif ($calculo2>=40) {
          $guardar2->estado="Obesidad Clase 3";
      }

       if($guardar2->estado=="Bajo Peso"){
        $guardar2->color="alert-warning";
      }elseif($guardar2->estado=="Peso Normal"){
        $guardar2->color="alert-success";
      }elseif ($guardar2->estado=="Sobrepeso" ||  $guardar2->estado=="Preobesidad" || $guardar2->estado=="Obesidad Clase 1" ||$guardar2->estado=="Obesidad Clase 2" || $guardar2->estado="Obesidad Clase 3" ) {
        $guardar2->color="alert-danger";
      }
      $guardar2->save();

        unset($guardar2['created_at']);
        unset($guardar2['updated_at']);

        ActivityLog::create([
            'log' => 'IMC',
            'descripcion' => 'Created',
            'fecha' => new \DateTime(),
            'responsable' => Auth::user()->email,
            'detalles' => json_encode($guardar2)
        ]);

       $carnet=Carnet_vacuna::all();

        foreach ($carnet as $car) {
            if ($request->edad>=$car->edadInicial && $request->edad<=$car->edadFinal) {
               $guardar3= new Vacuna;
              $guardar3->nombre=$car->nombre;
              $guardar3->legajo_id=$request->legajo;
              $guardar3->save(); 

              unset($guardar3['created_at']);
              unset($guardar3['updated_at']);

              ActivityLog::create([
                  'log' => 'Vacunas',
                  'descripcion' => 'Created',
                  'fecha' => new \DateTime(),
                  'responsable' => Auth::user()->email,
                  'detalles' => json_encode($guardar3)
              ]);
              
            }
             
        }
        $guardar4= new Control_Vacuna;
        $guardar4->legajo_id=$request->legajo;
        $guardar4->porcentaje=0;
        $guardar4->cantidad=0;
        if ($request->edad>19 &&$request->edad<26) {
          $guardar4->total_vacunas=19;
        }else{
          $guardar4->total_vacunas=16;
        }
        $guardar4->estado='Incompleto';
        $guardar4->color='alert-danger';
        $guardar4->save();

        unset($guardar4['created_at']);
        unset($guardar4['updated_at']);

        ActivityLog::create([
            'log' => 'Control Vacuna',
            'descripcion' => 'Created',
            'fecha' => new \DateTime(),
            'responsable' => Auth::user()->email,
            'detalles' => json_encode($guardar4)
        ]);

  		   return redirect()->route('empleado.informacion')->with(['guardado'=>'Empleado guardado con exito']);

   }


   public function datosEmpleados($id){

    $Empleados = Empleado::all()->where('legajo', $id);
    $Antecedentes_familiares = AntecedentesFamiliares::all()->where('legajo_id', $id);
    $Antecedentes_empleados = AntecedentesEmpleado::all()->where('legajo_id', $id);
    $Alergias = Alergia::all()->where('legajo_id', $id);
    $Dietas = Dieta::all()->where('legajo_id', $id);
    $Habitos = Habito::all()->where('legajo_id', $id);
    $Estudios = Estudio::all()->where('legajo_id', $id);

    // dd($Estudios);

     $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }

    return view('empleados.datosEmpleados', compact('Empleados', 'Antecedentes_familiares', 'Antecedentes_empleados', 'Alergias', 'Dietas','notificaciones','contadorNotificacion', 'Habitos', 'Estudios'));
   }

   public function cargarArea(Request $request){

     $guardarArea=new Area;
     $guardarArea->nombre=$request->nombre;
     $guardarArea->telefono=$request->telefono;
     $guardarArea->save();

        unset($guardarArea['created_at']);
        unset($guardarArea['updated_at']);

        ActivityLog::create([
            'log' => 'Area',
            'descripcion' => 'Created',
            'fecha' => new \DateTime(),
            'responsable' => Auth::user()->email,
            'detalles' => json_encode($guardarArea)
        ]);

    return redirect()->route('empleado.informacion')->with(['guardado'=>'Area Creada con exito, por favor vuelva a ingresar los datos']);

   }



 }
    

