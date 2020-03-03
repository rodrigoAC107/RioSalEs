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
                @include('includes.error')
                @include('includes.guardado')
                </center>
                <h1 class="h4 text-gray-900 mb-4">Nueva Consulta</h1>
              </div>
              <form class="user" method="POST" action="{{route('consultas.guardarConsultas')}}" aria-label="{{ __('Antecedentes del Empleado') }}" autocomplete="off">

                @csrf
                {{-- PRIMERA FILA --}}
                <div class="form-group row">
                	<div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('legajo_id') ? ' is-invalid' : '' }}" name="legajo_id" value="{{ old('legajo_id') }}" id="exampleLastName" placeholder="Legajo" autofocus>
                    @if ($errors->has('legajo_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('legajo_id') }}</strong>
                                    </span>
                    @endif
                  </div>
                 
                 
                 
                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="date" id="fecha_consulta" class="form-control form-control-user{{ $errors->has('fecha_consulta') ? ' is-invalid' : '' }}" name="fecha_consulta" value="{{ old('fecha_consulta') }}" required autofocus style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px" title="Fecha de Consulta">
                    @if ($errors->has('fecha_consulta'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fecha_consulta') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('tipo_consulta') ? ' is-invalid' : '' }}" name="tipo_consulta" value="{{ old('tipo_consulta') }}" id="exampleLastName" placeholder="Tipo de Consulta">
                    @if ($errors->has('tipo_consulta'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tipo_consulta') }}</strong>
                                    </span>
                    @endif
                  </div>
                   <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('motivo') ? ' is-invalid' : '' }}" name="motivo" value="{{ old('motivo') }}" id="exampleLastName" placeholder="Motivo">
                    @if ($errors->has('motivo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('motivo') }}</strong>
                                    </span>
                    @endif
                  </div>

                </div>
                {{-- SEGUNDA FILA --}}
                 <div class="form-group row">
                 
              
               
                </div>   

                  
               <hr>
               <hr>
				        <div class="text-center">
               
                <h1 class="h4 text-gray-900 mb-4">Signos Vitales</h1>
              	</div>
              	{{-- PRIMERA FILA SIGNOS --}}
              	<div class="form-group row">
              		 <div class="col-sm-3 mb-3 mb-sm-0">
                    	<input type="number" class="form-control form-control-user{{ $errors->has('temperatura') ? ' is-invalid' : '' }}" name="temperatura" value="{{ old('temperatura') }}" id="exampleLastName" placeholder="Temperatura">
                    	@if ($errors->has('temperatura'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('temperatura') }}</strong>
                                    </span>
                    	@endif
                  	</div>
                  	<div class="col-sm-3 mb-3 mb-sm-0">
                    	<input type="number" class="form-control form-control-user{{ $errors->has('sistolica') ? ' is-invalid' : '' }}" name="sistolica" value="{{ old('sistolica') }}" id="exampleLastName" placeholder="Sistolica">
                    	@if ($errors->has('sistolica'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('sistolica') }}</strong>
                                    </span>
                    	@endif
                  	</div>
                  	<div class="col-sm-3 mb-3 mb-sm-0">
                    	<input type="number" class="form-control form-control-user{{ $errors->has('diastolica') ? ' is-invalid' : '' }}" name="diastolica" value="{{ old('diastolica') }}" id="exampleLastName" placeholder="Diastolica">
                    	@if ($errors->has('diastolica'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('diastolica') }}</strong>
                                    </span>
                    	@endif
                  	</div>
                  	<div class="col-sm-3 mb-3 mb-sm-0">
                    	<input type="number" class="form-control form-control-user{{ $errors->has('frecuencia_arterial') ? ' is-invalid' : '' }}" name="frecuencia_arterial" value="{{ old('frecuencia_arterial') }}" id="exampleLastName" placeholder="Frecuencia Arterial">
                    	@if ($errors->has('frecuencia_arterial'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('frecuencia_arterial') }}</strong>
                                    </span>
                    	@endif
                  	</div>

              	</div>
              	{{-- SEGUNDA FILA SIGNOS VITALES --}}
              	<div class="form-group row">
              	<div class="col-sm-3 mb-3 mb-sm-0">
                    	<input type="number" class="form-control form-control-user{{ $errors->has('frecuencia_respiratoria') ? ' is-invalid' : '' }}" name="frecuencia_respiratoria" value="{{ old('frecuencia_respiratoria') }}" id="exampleLastName" placeholder="Frecuencia Respiratoria">
                    	@if ($errors->has('frecuencia_respiratoria'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('frecuencia_respiratoria') }}</strong>
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
{{-- Modal --}}

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel">Cargar Nueva Enfermedad</h5>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <div class="modal-body">
                  <form  class="user" method="POST" action="{{route('consultas.guardarEnfermedad')}}" aria-label="{{ __('Cargar Nueva Enfermedad') }}" autocomplete="off">
                  @csrf                
                  <div class="form-group row">
                     <div class="col-sm-6 mb-3 mb-sm-0">
                       <input type="text" class="form-control form-control-user{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}" id="exampleLastName" placeholder="Nombre de Enfermedad">
                              @if ($errors->has('nombre'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                              @endif
                        </div>
                  </div>
                  <div class="form-group row">
                     <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user{{ $errors->has('reposo') ? ' is-invalid' : '' }}" name="reposo" value="{{ old('reposo') }}" id="exampleLastName" placeholder="Dias de Reposo">
                              @if ($errors->has('reposo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('reposo') }}</strong>
                                    </span>
                              @endif
                  </div>
                          
                      
                  </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                  </form>
                </div>
                </div>
                  </div>
                  </div>
@endsection
@section('javascript')
<script type="text/javascript" src="{{asset('js/script_consultas/fecha.js')}}"></script>
@endsection