<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Notificacion;
use Carbon\Carbon;
use App\ActivityLog;
use Illuminate\Support\Facades\Auth;

class RegistrarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $fecha=Carbon::today();
        $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
        $contadorNotificacion=0;

        foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
        }

        
    	return view('registrar.crear',compact('notificaciones','contadorNotificacion'));
    }

    public function store(Request $request){
            $request->validate([

            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'role' => 'required',
            'dni' => 'required|numeric',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            
             ]);  

            $usuario = new User;

            $usuario->nombre = $request->name;
            $usuario->apellido = $request->lastname;
            $usuario->email = $request->email;
            $usuario->rol_id = $request->role;
            $usuario->dni = $request->dni;
            $usuario->password = Hash::make($request->password);

            //Subir la imagen
            if($request->imagen == '' || $request->imagen == null){
                
            }else{
            
            $images_path = $request->imagen;
            $binary_data = base64_decode($images_path);

            $nombre = $request->email.".jpg";

            Storage::disk('perfil')->put($nombre, $binary_data);

            $usuario->imagen = $nombre; 
            
            }

            $usuario->save();
            
            unset($usuario['created_at']);
            unset($usuario['updated_at']);

            ActivityLog::create([
                'log' => 'Usuarios',
                'descripcion' => 'Created',
                'fecha' => new \DateTime(),
                'responsable' => Auth::user()->email,
                'detalles' => json_encode($usuario)
            ]);

            $fecha=Carbon::today();
            $notificaciones=Notificacion::whereDate('fecha','>=',$fecha)->get();
            $contadorNotificacion=0;

            foreach ($notificaciones as $notificacion) {
            $contadorNotificacion++;
            }

   

        return redirect()->route('home',compact('notificaciones','contadorNotificacion'))->with([
                    'guardado' => 'Usuario creado con exito'
                ]);


    }
}
