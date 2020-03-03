@extends('layouts.app2')

@section('content')
<div class="card shadow mb-4">   
<div class="card-body">
     <div><a href="{{ URL::previous() }}" class="btn btn-info m-1"><i class="fas fa-chevron-left"></i></a></div>

        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            @foreach($editarEmpleado as $empleado)

           <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Editar Paciente</h1>
              </div>
              <div class="d-flex justify-content-center text-center text-uppercase pb-3">
              @include('includes.guardado')
              </div>
              <form class="user" method="POST" action="{{route('empleado.update',$empleado->legajo)}}" aria-label="{{ __('Crear Paciente') }}" autocomplete="off">
                {{method_field('PUT')}}
                @csrf
                {{-- PRIMERA FILA --}}
                <div class="form-group row">
                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('legajo') ? ' is-invalid' : '' }}" name="legajo" required autofocus value="{{$empleado->legajo}}" readonly>
                    @if ($errors->has('legajo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('legajo') }}</strong>
                                    </span>
                    @endif
                  </div>
                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{$empleado->nombre}}">
                    @if ($errors->has('nombre'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                    @endif
                  </div>

                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('apellido') ? ' is-invalid' : '' }}" name="apellido" value="{{$empleado->apellido}}">
                    @if ($errors->has('apellido'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('apellido') }}</strong>
                                    </span>
                    @endif
                  </div>
                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <select id="cargo" name="cargo" class="form-control form-control-user{{ $errors->has('cargo') ? ' is-invalid' : '' }}" value="{{ old('cargo') }}" required autofocus style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px">
                    <option selected readonly value="{{$empleado->cargo}}">{{$empleado->cargo}}</option>
                                <option>Director</option>
                                <option>Encargado</option>
                                <option>Empleado</option>   
                    </select>
                    @if ($errors->has('cargo'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('cargo') }}</strong>
                        </span>
                    @endif
                    
                  </div>
                </div>

                {{-- SEGUNDA FILA --}}
                <div class="form-group row">
                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <select id="area_trabajo" class="form-control form-control-user{{ $errors->has('area_trabajo') ? ' is-invalid' : '' }}" name="area_trabajo" value="{{ old('area_trabajo') }}" required autofocus style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px">
                    <option selected readonly value="{{$empleado->area_trabajo}}">{{$empleado->area_trabajo}}</option>
                                @foreach($areas as $area)
                                <option>{{$area->nombre}}</option>
                                @endforeach    
                    </select>
                    @if ($errors->has('area_trabajo'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('area_trabajo') }}</strong>
                        </span>
                    @endif
                    
                  </div>

                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="date" class="form-control form-control-user{{ $errors->has('fecha_nacimiento') ? ' is-invalid' : '' }}" name="fecha_nacimiento" value="{{$empleado->fecha_nacimiento}}" required autofocus style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px" title="Fecha de Nacimiento">
                    @if ($errors->has('fecha_nacimiento'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
                                    </span>
                    @endif
                  </div>
                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('cuil') ? ' is-invalid' : '' }}" name="cuil" value="{{$empleado->cuil}}" required autofocus placeholder="CUIL">
                    @if ($errors->has('cuil'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cuil') }}</strong>
                                    </span>
                    @endif
                  </div>
                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('edad') ? ' is-invalid' : '' }}" name="edad" value="{{$empleado->edad}}" required autofocus pattern="[0-9]{2}" title="Solo ingresa 2 números">
                    @if ($errors->has('edad'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('edad') }}</strong>
                                    </span>
                    @endif
                  </div>               
              </div>
                {{-- TERCERA FILA --}}
              <div class="form-group row">
                  <div class="col-sm-3 mb-3 mb-sm-0">
                      <select id="anteojos" name="anteojos" class="form-control form-control-user{{ $errors->has('anteojos') ? ' is-invalid' : '' }}" name="anteojos" value="{{$empleado->anteojos}}" required autofocus style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px" title="Utiliza Anteojos?">
                                  <option selected value="{{$empleado->anteojos}}">{{$empleado->anteojos}}</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                      </select>
  
                      @if ($errors->has('anteojos'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('anteojos') }}</strong>
                          </span>
                      @endif
                    </div>
                <div class="col-sm-3 mb-3 mb-sm-0">
                      <select class="form-control form-control-user{{ $errors->has('sexo') ? ' is-invalid' : '' }}" name="sexo" value="{{ old('sexo') }}" required autofocus style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px" title="Sexo">
                                  <option selected value="{{$empleado->sexo}}">{{$empleado->sexo}}</option>
                                  <option>Masculino</option>
                                  <option>Femenino</option>
                      </select>
                      @if ($errors->has('sexo'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('sexo') }}</strong>
                          </span>
                      @endif
                  </div>
                <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('nacionalidad') ? ' is-invalid' : '' }}" name="nacionalidad" value="{{$empleado->nacionalidad}}" required autofocus>
                    @if ($errors->has('nacionalidad'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nacionalidad') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="date" class="form-control form-control-user{{ $errors->has('fecha_alta') ? ' is-invalid' : '' }}" name="fecha_alta" value="{{$empleado->fecha_alta}}" required autofocus style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px" title="Fecha de Alta">
                    @if ($errors->has('fecha_alta'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fecha_alta') }}</strong>
                                    </span>
                    @endif
                </div>
                 
              </div>
              {{-- CUARTA FILA --}}
              <div class="form-group row">
                  <div class="col-sm-3 mb-3 mb-sm-0">
                      <select id="estado_civil" name="estado_civil" class="form-control form-control-user{{ $errors->has('estado_civil') ? ' is-invalid' : '' }}" name="estado_civil" required autofocus style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px" title="Estado Civil">
                                  <option disabled value="{{$empleado->estado_civil}}">{{$empleado->estado_civil}}</option>
                                  <option>Soltero/a</option>
                                  <option>Casado/a</option>
                                  <option>Divorciado/a</option>
                                  <option>Viudo/a</option>
                      </select>

                      @if ($errors->has('estado_civil'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('estado_civil') }}</strong>
                          </span>
                      @endif
                  </div>
                <div class="col-sm-3 mb-3 mb-sm-0">
                      <select id="grupo_sanguineo" name="grupo_sanguineo" class="form-control form-control-user{{ $errors->has('grupo_sanguineo') ? ' is-invalid' : '' }}" name="grupo_sanguineo" required autofocus style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px" title="Estado Civil">
                                  <option selected value="{{$empleado->grupo_sanguineo}}">{{$empleado->grupo_sanguineo}}</option>
                                  <option value="O+">O+</option>
                                  <option value="O-">O-</option>
                                  <option value="AB+">AB+</option>
                                  <option value="AB-">AB-</option>
                                  <option value="A+">A+</option>
                                  <option value="A-">A-</option>
                                  <option value="B+">B+</option>
                                  <option value="B-">B-</option>
                      </select>

                      @if ($errors->has('grupo_sanguineo'))
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $errors->first('grupo_sanguineo') }}</strong>
                          </span>
                      @endif
                  </div>
                <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" value="{{$empleado->telefono}}" required autofocus  title="Solo ingrese numeros" pattern="[0-9]+">
                    @if ($errors->has('telefono'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('telefono') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="col-sm-3 mb-3 mb-sm-0">
                  <input type="email" class="form-control form-control-user{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{$empleado->email}}" required id="exampleInputEmail" placeholder="Email" autocomplete="off">
                  @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                  @endif
                </div>
              </div>
              {{-- QUINTA FILA --}}
              <div class="form-group row">
                <div class="col-sm-5 mb-3 mb-sm-0">
                  <input type="text" class="form-control form-control-user{{ $errors->has('domicilio') ? ' is-invalid' : '' }}" name="domicilio" value="{{$empleado->domicilio}}" required id="exampleInputEmail" placeholder="Domicilio" autocomplete="off">
                  @if ($errors->has('domicilio'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('domicilio') }}</strong>
                                    </span>
                  @endif
                </div>
                
              </div>
               <div class="form-row">
                <div class="col-xs-4 mt-2 ml-5" id="my_camera" style="width:200px; height:240px;"></div>
                <input id="imagen" type="hidden" name="imagen" value=""/ class="rounded" required>
                <input id="oldimagen" type="hidden" name="oldimagen" value=""/ required>
                <div class="col-md-4 mx-5 mt-1" id="my_result">
                  {{-- <img id="imagenvisitante" src=""/ style="width:320px; height:219px;" class="rounded d-print-flex" required> --}}
                  Esperando captura de la foto...
                </div>
                <div class="col-xs-4 mt-2 ml-5">
                  @if($empleado->imagen)
                  <p>Foto actual:</p>
                  <img src="{{ asset('storage/perfilEmpleado/' . $empleado->imagen)  }}" class="rounded" style="width:175px; height:160px;">
                  @else
                  <p>No tiene foto actual</p>
                  @endif
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-xs-6 ml-3">
                  <input type="button" class="btn btn-success" onclick="take_snapshot()" value="Tomar foto">
                </div>
              </div>

                <div class="form-group row d-flex justify-content-center mt-4">
                            <div class="col-xs-2">
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    {{ __('ACTUALIZAR') }}
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
  </div>

  <script type="text/javascript">
      Webcam.attach('#my_camera');
         
         function take_snapshot() {
             Webcam.snap( function(data_uri) {
           var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
          //  document.getElementById('imagenvisitante').src = data_uri;         
           document.getElementById('imagen').value = raw_image_data;
           document.getElementById('my_result').innerHTML = 
           '<p>Foto capturada:</p>' + 
            '<img src="'+data_uri+'" id="imagenvisitante" style="width:175px; height:160px;"/>';
         } );
         }
   </script>
@endsection