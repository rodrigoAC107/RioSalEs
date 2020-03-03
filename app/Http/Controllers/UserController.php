<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Tipo_Rol;
use Illuminate\Support\Facades\Storage;
use App\Notificacion;
use Carbon\Carbon;
use App\ActivityLog;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $usuarios=User::all();
        $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }

        
        return view('usuarios.indexUsuario',compact('usuarios','notificaciones','contadorNotificacion'));
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
        $usuarios=User::where('id',$id)->get();
        $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }

        
        return view('usuarios.editarUsuario',compact('usuarios','notificaciones','contadorNotificacion'));
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

            'nombre' => 'required|alpha|max:255',
            'apellido' => 'required|alpha|max:255',
            'rol_id' => 'required',
            'dni' => 'required|numeric',
            'email' => 'required|string|email|max:255',
            
            
             ]);  

        $user=User::where('id',$id)->get();

        foreach ($user as $use) {
            $use->nombre=$request->nombre;
            $use->apellido=$request->apellido;
            $use->email=$request->email;
            $use->rol_id=$request->rol_id;
            $use->dni=$request->dni;
        }
        $usuarioOld = new User();
            $usuarioOld->nombre=$use->nombre;
            $usuarioOld->apellido=$use->apellido;
            $usuarioOld->email=$use->email;
            $usuarioOld->rol_id=$use->rol_id;
            $usuarioOld->dni=$use->dni;


        //Subir la imagen
        if($request->imagen == '' || $request->imagen == null){
            
        }else{
        
        $images_path = $request->imagen;
        $binary_data = base64_decode($images_path);

        $nombre = $request->email.".jpg";

        Storage::disk('perfil')->put($nombre, $binary_data);

        $use->imagen = $nombre; 

            
        $usuarioOld->imagen=$use->imagen;
        
        
        }

        $use->update();

        // dd($usuarioOld);

        unset($use['created_at']);
        unset($use['updated_at']);

        ActivityLog::create([
            'log' => 'Usuario',
            'descripcion' => 'Updated',
            'fecha' => new \DateTime(),
            'responsable' => Auth::user()->email,
            'detalles' => 'old: '.json_encode($usuarioOld).', new: '.json_encode($use)
        ]);

        $usuarios=User::all();
        $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();  
        return redirect()->route('usuarios.index',compact('usuarios','notificaciones'))->with('guardado','Usuario Actualizado con Exito!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $prueba=User::where('id',$id)->get();
    //     $prueba->delete();
        
        
    //     $usuarios=User::all();  
    //     return redirect()->route('usuarios.index',compact('usuarios'))->with('guardado','Usuario Eliminado con Exito!!!');
    // }


    public function delete($id){
        $usuario = User::where('id', $id);
         $prueba=User::where('id',$id)->get();
         
         foreach($prueba as $Prueba){
             
             $usuarioOld = new User();
             $usuarioOld->nombre=$Prueba->nombre;
             $usuarioOld->apellido=$Prueba->apellido;
             $usuarioOld->email=$Prueba->email;
             $usuarioOld->rol_id=$Prueba->rol_id;
             $usuarioOld->dni=$Prueba->dni;
             $usuarioOld->dni=$Prueba->imagen;

        }
            
         $usuario->delete();
 
         ActivityLog::create([
             'log' => 'Usuario',
             'descripcion' => 'Deleted',
             'fecha' => new \DateTime(),
             'responsable' => Auth::user()->email,
             'detalles' => json_encode($usuarioOld)
         ]);
        
        $usuarios=User::all();  
        return redirect()->route('usuarios.index',compact('usuarios'))->with('guardado','Usuario Eliminado con Exito!!!');
    }
}
