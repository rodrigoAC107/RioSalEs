@extends('empleados.index')

@section('contenido')
      <div class="card-body">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Agregar Nuevo Paciente</h1>
              </div>
              <div class="d-flex justify-content-center text-center text-uppercase pb-3">
              @include('includes.guardado')
              </div>
              <form class="user" method="POST" action="{{route('empleado.guardar')}}" aria-label="{{ __('Crear Paciente') }}" autocomplete="off">

                @csrf
                {{-- PRIMERA FILA --}}
                <div class="form-group row">
                  <div class="col-sm-2 mb-3 mb-sm-0">
                    <select id="area_trabajo" class="form-control form-control-user{{ $errors->has('area_trabajo') ? ' is-invalid' : '' }}" name="area_trabajo" value="{{ old('area_trabajo') }}" required autofocus style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px">
                                <option selected disabled>Area de Trabajo</option>
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
                    <div class="col-sm-1 mb-0 mb-sm-0">
                       <button type="button" class="tn btn-primary btn-user btn-block" title="Agregar Nueva Area" data-toggle="modal" data-target="#nuevaArea"><i class="far fa-plus-square"></i></button>
                    </div>

                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('legajo') ? ' is-invalid' : '' }}" name="legajo" value="{{ old('legajo') }}" required autofocus id="exampleFirstName" placeholder="Legajo">
                    @if ($errors->has('legajo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('legajo') }}</strong>
                                    </span>
                    @endif
                  </div>

                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}" id="exampleLastName" placeholder="Nombre" >
                    @if ($errors->has('nombre'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                    @endif
                  </div>
                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('apellido') ? ' is-invalid' : '' }}" name="apellido" value="{{ old('apellido') }}" id="exampleLastName" placeholder="Apellido">
                    @if ($errors->has('apellido'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('apellido') }}</strong>
                                    </span>
                    @endif
                  </div>
                 
                </div>

                {{-- SEGUNDA FILA --}}
                <div class="form-group row">
                   <div class="col-sm-3 mb-3 mb-sm-0">
                    <select id="cargo" name="cargo" class="form-control form-control-user{{ $errors->has('cargo') ? ' is-invalid' : '' }}" value="{{ old('cargo') }}" required autofocus style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px">
                                <option selected disabled>Cargo</option>
                               
                                <option>Encargado</option>
                                <option>Empleado</option>   
                    </select>
                    @if ($errors->has('cargo'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('cargo') }}</strong>
                        </span>
                    @endif
                    
                  </div>

                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="date" class="form-control form-control-user{{ $errors->has('fecha_nacimiento') ? ' is-invalid' : '' }}" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" id="fecha_nacimiento" placeholder="Fecha de Nacimiento" required autofocus style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px" title="Fecha de Nacimiento">
                    @if ($errors->has('fecha_nacimiento'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
                                    </span>
                    @endif
                  </div>
                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('cuil') ? ' is-invalid' : '' }}" name="cuil" value="{{ old('cuil') }}" required autofocus placeholder="CUIL">
                    @if ($errors->has('cuil'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cuil') }}</strong>
                                    </span>
                    @endif
                  </div>
                   <div class="col-sm-3 mb-3 mb-sm-0">
                    <select id="anteojos" name="anteojos" class="form-control form-control-user{{ $errors->has('anteojos') ? ' is-invalid' : '' }}" name="anteojos" value="{{ old('anteojos') }}" required autofocus style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px" title="Utiliza Anteojos?">
                                <option selected disabled>Utiliza anteojos?</option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                    </select>

                    @if ($errors->has('anteojos'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('anteojos') }}</strong>
                        </span>
                    @endif
                  </div>
              </div>
                {{-- TERCERA FILA --}}
              <div class="form-group row">
                <div class="col-sm-3 mb-3 mb-sm-0">
                      <select id="estado_civil" name="estado_civil" class="form-control form-control-user{{ $errors->has('estado_civil') ? ' is-invalid' : '' }}" name="estado_civil" value="{{ old('estado_civil') }}" required autofocus style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px" title="Estado Civil">
                                  <option disabled selected>Estado Civil</option>
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
                      <select class="form-control form-control-user{{ $errors->has('sexo') ? ' is-invalid' : '' }}" name="sexo" value="{{ old('sexo') }}" required autofocus style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px" title="Sexo">
                                  <option disabled selected>Sexo</option>
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
                    <input type="text" class="form-control form-control-user{{ $errors->has('nacionalidad') ? ' is-invalid' : '' }}" name="nacionalidad" value="{{ old('nacionalidad') }}" required autofocus id="exampleLastName" placeholder="Nacionalidad">
                    @if ($errors->has('nacionalidad'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nacionalidad') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="date" class="form-control form-control-user{{ $errors->has('fecha_alta') ? ' is-invalid' : '' }}" name="fecha_alta" value="{{ old('fecha_alta') }}" required autofocus style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px" id="fecha_alta" title="Fecha de Alta" placeholder="Fecha de Alta">
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
                  <input type="email" class="form-control form-control-user{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required id="exampleInputEmail" placeholder="Email" autocomplete="off">
                  @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                  @endif
                </div>
               <div class="col-sm-3 mb-3 mb-sm-0">
                      <select id="grupo_sanguineo" name="grupo_sanguineo" class="form-control form-control-user{{ $errors->has('grupo_sanguineo') ? ' is-invalid' : '' }}" name="grupo_sanguineo" required autofocus style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px" title="Estado Civil">
                                  <option selected disabled>Grupo Sanguineo</option>
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
                    <input type="text" class="form-control form-control-user{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" value="{{ old('telefono') }}" required autofocus id="exampleLastName" placeholder="Telefono" title="Solo ingrese numeros" pattern="[0-9]+">
                    @if ($errors->has('telefono'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('telefono') }}</strong>
                                    </span>
                    @endif
                </div>
                <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('edad') ? ' is-invalid' : '' }}" name="edad" value="{{ old('edad') }}" required autofocus placeholder="Edad" pattern="[0-9]{2}" title="Solo ingresa 2 números">
                    @if ($errors->has('edad'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('edad') }}</strong>
                                    </span>
                    @endif
                  </div>
              </div>
              {{-- QUINTA FILA --}}
              <div class="form-group row">
                <div class="col-sm-2 mb-3 mb-sm-0">
                    <div class="input-group">
                    <input type="text" class="form-control form-control-user{{ $errors->has('estatura') ? ' is-invalid' : '' }}" name="estatura" value="{{ old('estatura') }}" required autofocus id="exampleLastName" placeholder="Estatura" title="Ingrese Valores en Centimetros" pattern="[0-9]+">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Cm.</span>
                     </div> 
                    @if ($errors->has('estatura'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('estatura') }}</strong>
                                    </span>
                    @endif
                    </div>
                </div>
                 <div class="col-sm-2 mb-3 mb-sm-0">
                  <div class="input-group">
                  <input type="text" class="form-control form-control-user{{ $errors->has('peso') ? ' is-invalid' : '' }}" name="peso" value="{{ old('peso') }}" required autofocus id="exampleLastName" placeholder="Peso" title="Peso en Kg" pattern="[0-9]+">
                  <div class="input-group-prepend">
                      <span class="input-group-text">Kg.</span>
                  </div> 
                    @if ($errors->has('Peso'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('Peso') }}</strong>
                                    </span>
                    @endif
                  </div>
                </div>
                <div class="col-sm-4 mb-3 mb-sm-0">
                  <input type="text" class="form-control form-control-user{{ $errors->has('domicilio') ? ' is-invalid' : '' }}" name="domicilio" value="{{ old('domicilio') }}" required id="exampleInputEmail" placeholder="Domicilio" autocomplete="off">
                  @if ($errors->has('domicilio'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('domicilio') }}</strong>
                                    </span>
                  @endif
                </div>
                
              </div>
              <div class="row">
						    <div class="col-xs-4 mt-5" id="my_camera" style="width:320px; height:240px;"></div>
						    <input id="imagen" type="hidden" name="imagen" value=""/ required>
						    <input id="oldimagen" type="hidden" name="oldimagen" value=""/ required>
						    <div class="col-xs-4 mx-5" id="my_result">
                  {{-- <img id="imagenvisitante" src=""/ style="" required> --}}
                  Esperando captura de la foto...
						    </div>
						  </div>
						  <br>
						  <div class="row">
						    <input type="button" class="btn btn-success" onclick="take_snapshot()" value="Tomar foto">
						  </div>
						  <br>
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
    @include('empleados.modal.modalAreas')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
  
    document.getElementById('fecha_nacimiento').type='text';
    document.getElementById('fecha_alta').type='text';  
    document.getElementById('fecha_nacimiento').addEventListener('focus',function(){

      document.getElementById('fecha_nacimiento').type= 'date';

    });
    document.getElementById('fecha_alta').addEventListener('focus',function(){

      document.getElementById('fecha_alta').type= 'date';

    });

</script>
<script type="text/javascript">
      Webcam.attach('#my_camera');
         
         function take_snapshot() {
             Webcam.snap( function(data_uri) {
           var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
          //  document.getElementById('imagenvisitante').src = data_uri;					
           document.getElementById('imagen').value = raw_image_data;
           document.getElementById('my_result').innerHTML = 
           '<p>Foto capturada:</p>' + 
            '<img src="'+data_uri+'" id="imagenvisitante"/>';
         } );
         }


         

</script>
  @endsection
