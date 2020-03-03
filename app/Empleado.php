<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Empleado extends Model
{
	
   public function dieta(){

		return $this->hasOne('App\Dieta','legajo_id','legajo');
	}
	
	public function alergia(){

		return $this->hasMany('App\Alergia','legajo_id','legajo');

	}
	 public function controlVacuna(){
        
        return $this->hasOne('App\Control_Vacuna','legajo_id','legajo');

    }
	
	public function relacionVacunas(){
		
		return $this->hasMany('App\Vacuna','legajo_id','legajo');
    
    }

	public function donacion(){

		return $this->hasOne('App\Donacion','legajo_id','legajo');
	}

	public function antecedentes_f(){

    	return $this->hasOne('App\Antecedentes_familiare','legajo_id','legajo');
    }
    public function antecedentes_e(){

    	return $this->hasOne('App\Antecedentes_empleado','legajo_id','legajo');
    }

    public function consultas(){

		return $this->hasOne('App\Consulta','legajo_id','legajo');

	}

	public function estudios(){

		return $this->hasOne('App\Estudio','legajo_id','legajo');

	}
	
	protected $filiable=[
		'legajo', 'email',
		'nombre','apellido','area_trabajo','cargo',
		'fecha_nacimiento','cuil','edad',
		'sexo','domicilio','nacionalidad',
		'fecha_alta','estado_civil','grupo_sanguineo',
		'telefono','anteojos'];

	
}
