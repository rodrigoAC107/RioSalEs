@extends('layouts.app2')




@section('content')

<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body">
      	 <div><a href="{{ URL::previous() }}" class="btn btn-info m-1"><i class="fas fa-chevron-left"></i></a></div>
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
          	@foreach($empleadoDieta as $empleado)
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Editando dieta de {{$empleado->dieta['apellido']}} {{$empleado->dieta['nombre']}}</h1>
              </div>
                 <div class="justify-content-center text-center text-uppercase py-1 d-block d-xl-none d-lg-none" style="font-size: x-large;font-size: 3vw">
                @include('includes.error')
                @include('includes.guardado')
                </div>
              <div class="justify-content-center text-center text-uppercase py-1 d-none d-xl-block d-lg-block" style="font-size: x-large;font-size: 2vw">
                @include('includes.error')
                @include('includes.guardado')
              </div>
              
              <form class="user" method="POST" id="form" action="{{route('informe-dietas.editarDatos')}}" autocomplete="on" {{-- onKeypress="if(event.keyCode == 13) event.returnValue = false;" --}}>
             
                @csrf
                <div class="form-group row">
                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('legajo_id') ? ' is-invalid' : '' }}" name="legajo_id" value="{{$empleado->legajo_id}}" required autofocus id="legajo_id" placeholder="Legajo" readonly>
                  </div>
                  @if($empleado->tipo_2!=null)
                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <select id="tipo_1" name="tipo_1" class="form-control form-control-user{{ $errors->has('tipo_1') ? ' is-invalid' : '' }}" value="{{$empleado->tipo_1}}" required autofocus style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px">
                               <option>{{$empleado->tipo_1}}</option>
                                @foreach($dietas as $dieta)

                                <option>{{$dieta->tipo}}</option>
                                @endforeach
                    </select>
                  </div>
                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <select id="tipo_2" name="tipo_2" class="form-control form-control-user{{ $errors->has('tipo_2') ? ' is-invalid' : '' }}" value="{{$empleado->tipo_2}}" required autofocus style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px">
                               <option>{{$empleado->tipo_2}}</option>
                                @foreach($dietas as $dieta)
                                <option>{{$dieta->tipo}}</option>
                                @endforeach
                    </select>
                  </div>
                  @else
                  	<div class="col-sm-3 mb-3 mb-sm-0">
                    	 <select id="tipo_1" name="tipo_1" class="form-control form-control-user{{ $errors->has('tipo_1') ? ' is-invalid' : '' }}" value="{{$empleado->tipo_1}}" required autofocus style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px">
                               <option>{{$empleado->tipo_1}}</option>
                                @foreach($dietas as $dieta)
                                <option>{{$dieta->tipo}}</option>
                                @endforeach
                    	</select>
                  	</div>

                  @endif


                  
                </div>
                <div class="form-group row">
	                	<div class="col-sm-6 mb-3 mb-sm-0">
	                    	<input type="text" class="form-control form-control-user{{ $errors->has('comidas_permitidas') ? ' is-invalid' : '' }}" name="comidas_permitidas" value="{{$empleado->comidas_permitidas}}" required autofocus id="comidas_permitidas" placeholder="comidas_permitidas">
	                  	</div>
	                
	                  	<div class="col-sm-6 mb-3 mb-sm-0">
	                    	<input type="text" class="form-control form-control-user{{ $errors->has('comidas_no_permitidas') ? ' is-invalid' : '' }}" name="comidas_no_permitidas" value="{{$empleado->comidas_no_permitidas}}" required autofocus id="comidas_no_permitidas" placeholder="comidas_no_permitidas">
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




@endsection