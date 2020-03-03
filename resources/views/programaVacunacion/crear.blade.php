@extends('layouts.app2')




@section('content')
<div class="card">
<div class="card-head">
<div class="container">
<div class="container-fluid">

<div class="card-body">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
              <div class="text-center">
                <center>
                @include('includes.guardado')
                </center>
                <h1 class="h4 text-gray-900 mb-4">Programa de Vacunacion</h1>
              </div>
              <form class="user" method="POST" action="{{route('programaVacunacion.store')}}" aria-label="{{ __('Programa de Vacunacion') }}" autocomplete="off">

                @csrf
                {{-- PRIMERA FILA --}}
                <div class="form-group row">
                	<div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('nombre_programa') ? ' is-invalid' : '' }}" name="nombre_programa" value="{{ old('nombre_programa') }}" id="exampleLastName" placeholder="Nombre del Programa" autofocus>
                    @if ($errors->has('nombre_programa'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombre_programa') }}</strong>
                                    </span>
                    @endif
                  </div>

                 <div class="col-sm-3 mb-3 mb-sm-0">
                    <select id="vacuna"  class="form-control form-control-user{{ $errors->has('vacuna') ? ' is-invalid' : '' }}" name="vacuna" value="{{ old('vacuna') }}" required autofocus style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px">
                                <option selected disabled>Seleccionar Vacuna</option>
                                <option>Gripe</option>
                                <option>Heamophilus Influenzae tipo B</option>
                                <option>Tetanos</option>
                                <option>Triple Viral</option>
                                <option>Herpes Zoster</option>
                                <option>Neumococo Conjugada</option>
                                <option>Neumococo Polisacarida</option>
                                <option>Meningococo A</option>
                                <option>Meningococo B</option>
                                <option>Varicela</option>
                                <option>Hepatitis A</option>
                                <option>Hepatitis B</option>
                                <option>HPV</option>
                               
                               
                    </select>
                  </div>

                  <div class="col-sm-3 mb-3 mb-sm-0">
                   <select id="dosis" name="dosis" class="form-control form-control-user{{ $errors->has('dosis') ? ' is-invalid' : '' }}" value="{{ old('dosis') }}" required autofocus style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px">
                                <option selected disabled>Dosis</option>

                                  
                    </select>
                     
                    @if ($errors->has('dosis'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dosis') }}</strong>
                                    </span>
                    @endif
                  
                  </div>

                 
                 
                 
                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="date"class="form-control form-control-user{{ $errors->has('fecha_programa') ? ' is-invalid' : '' }}" name="fecha_programa" value="{{ old('fecha_programa') }}" required autofocus style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px" placeholder="Fecha del Programa" title="Fecha del Programa" min="{{$fechaDeHoy}}" id="fechaPrograma">
                    @if ($errors->has('fecha_programa'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fecha_programa') }}</strong>
                                    </span>
                    @endif
                </div>

                 
               
                </div>
                {{-- SEGUNDA FILA --}}
                 <div class="form-group row">
                 
                 <div class="col-sm-3 mb-3 mb-sm-0">
                    <select id="area"  class="form-control form-control-user{{ $errors->has('area') ? ' is-invalid' : '' }}" name="area" value="{{ old('area') }}" required autofocus style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px">
                                <option selected disabled>Seleccionar Area</option>
                                @foreach($areas as $area)
                                <option>{{$area->nombre}}</option>

                                @endforeach
                               
                    </select>
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('mensaje') ? ' is-invalid' : '' }}" name="mensaje" value="{{ old('mensaje') }}" id="exampleLastName" placeholder="Mensaje" autofocus>
                    @if ($errors->has('mensaje'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('mensaje') }}</strong>
                                    </span>
                    @endif
                  </div>

                
                </div>   
	       
              	 <div class="form-group row d-flex justify-content-center">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    {{ __('GUARDAR') }}
                                </button>
                            </div>
                </div>

                  
              </form>
               
          </div>
        </div>
      </div>
</div>
</div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript">
</script>

<script type="text/javascript">
  
$('#vacuna').on('change', function() {
      var valor=$('#vacuna').val();

      if(valor=='Gripe'|| valor=='Heamophilus Influenzae tipo B'||valor=='Tetanos'|| valor=='Triple Viral'||valor=='Herpes Zoster' || valor=='Neumococo Conjugada'|| valor=='Neumococo Polisacarida'|| valor=='Meningococo A'){
        $('#dosis').empty();
        $('#dosis').prepend("<option value='Primera Dosis' >Primera Dosis</option>");
      }
      else if(valor=='Meningococo B'|| valor=='Varicela'|| valor=='Hepatitis A'){
         $('#dosis').empty();
        $('#dosis').prepend("<option value='Primera Dosis' >Primera Dosis</option>");
        $('#dosis').prepend("<option value='Segunda Dosis' >Segunda Dosis</option>");
      }
      else if(valor=='Hepatitis B'|| valor=='HPV'){
         $('#dosis').empty();
         $('#dosis').prepend("<option value='Primera Dosis' >Primera Dosis</option>");
         $('#dosis').prepend("<option value='Segunda Dosis' >Segunda Dosis</option>");
          $('#dosis').prepend("<option value='Tercera Dosis' >Tercera Dosis</option>");
       }
      }
      
        );
     
</script>

<script type="text/javascript">
  document.getElementById('fechaPrograma').type='text';
  document.getElementById('fechaPrograma').addEventListener('focus',function(){

      document.getElementById('fechaPrograma').type= 'date';

    });
</script>
@endsection