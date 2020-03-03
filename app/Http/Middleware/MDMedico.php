<?php

namespace App\Http\Middleware;

use Closure;

class MDMedico
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $usuario_actual=\Auth::user();
        if($usuario_actual->rol_id!=2 && $usuario_actual->rol_id!=1){
            return redirect()->route('denied')->with([
                'msj'=>'No tiene suficientes privilegios para acceder a esta seccíon'
            ]);
        }
        return $next($request);
    }
}
