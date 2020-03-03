@extends('layouts.app2')



@section('content')
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body">
<div><a href="{{ URL::previous() }}" class="btn btn-info m-1"><i class="fas fa-chevron-left"></i></a></div>

        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Cargar Vacuna</h1>

              </div>
            @foreach($empleados as $empleado)
           <form class="user" method="get" action="{{route('vacunas.edit',$empleado->legajo)}}" aria-label="{{ __('Cargar Vacunas') }}" autocomplete="off">

                @csrf
                {{-- PRIMERA FILA --}}
                
                <div class="form-group row">
                	<div class="col-sm-3 mb-3 mb-sm-0">
                    <select id="nombre" name="nombre" class="form-control form-control-user{{ $errors->has('nombre') ? ' is-invalid' : '' }}" value="{{ old('nombre') }}" required autofocus style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px">
                                
                                <option selected disabled>Nombre</option>
                                @foreach($vacunas as $vacuna)
                                <option>{{$vacuna->nombre}}</option>
                                
                                @endforeach
                    </select>
                    @if ($errors->has('cargo'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('cargo') }}</strong>
                        </span>
                    @endif
                    
                  </div>
                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <select id="dosis" name="dosis" class="form-control form-control-user{{ $errors->has('dosis') ? ' is-invalid' : '' }}" value="{{ old('dosis') }}" required autofocus style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px">
                                <option selected disabled>N° de dosis</option>
                                <option>Primera Dosis</option>
                                <option>Segunda Dosis</option>
                                <option>Tercera Dosis</option> 
                    </select>
                    @if ($errors->has('cargo'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('cargo') }}</strong>
                        </span>
                    @endif
                  </div>
                 
                  

                  <div class="col-sm-4 mb-3 mb-sm-0">
                    <input type="date" class="form-control form-control-user{{ $errors->has('fecha') ? ' is-invalid' : '' }}" name="fecha" style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px" value="{{ old('fecha') }}" id="fecha" placeholder="Fecha de Vacuna">
                    @if ($errors->has('fecha'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fecha') }}</strong>
                                    </span>
                    @endif
                  </div>
                  
              </div>

               
                <div class="form-group row d-flex justify-content-center">
                            <div class="col-md-4" >
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    {{ __('GUARDAR') }}
                                </button>
                            </div>
                </div>
              </form>
              @endforeach
          	  

             	
              		
              
          </div>
        </div>
       </div>
    </div>
 </div>
<script type="text/javascript">
  document.getElementById('fecha').type='text';
  document.getElementById('fecha').addEventListener('focus',function(){

      document.getElementById('fecha').type= 'date';

    });
</script>

@endsection