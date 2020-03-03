@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Crear Cuenta</h1>
              </div>
              <form class="user" method="POST" action="{{ route('registrar.store') }}" aria-label="{{ __('Crear Usuario') }}" autocomplete="off">

                @csrf

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus id="exampleFirstName" placeholder="Nombre">
                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                    @endif
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('lastname') }}" id="exampleLastName" placeholder="Apellidos">
                    @if ($errors->has('lastname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                    @endif
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('dni') ? ' is-invalid' : '' }}" name="dni" value="{{ old('email') }}" required autofocus id="exampleFirstName" placeholder="DNI">
                    @if ($errors->has('dni'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dni') }}</strong>
                                    </span>
                    @endif
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <select id="role" name="role" class="form-control form-control-user{{ $errors->has('role') ? ' is-invalid' : '' }}" name="role" value="{{ old('role') }}" required autofocus style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px">
                                <option selected value="1">Administrador</option>
                                <option value="2">Medico</option>
                                <option value="3">Enfermero</option>
                    </select>

                    @if ($errors->has('role'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('role') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>


                <div class="form-group">
                  <input type="email" class="form-control form-control-user{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required id="exampleInputEmail" placeholder="Email">
                  @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                  @endif
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required id="exampleInputPassword" placeholder="Contraseña">
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="password-confirm" name="password_confirmation" required placeholder="Repetir Contraseña">
                  </div>
                </div>

                <div class="form-row">
                    <div class="col-xs-4 mt-2" id="my_camera" style="width:200px; height:240px;"></div>
                    <input id="imagen" type="hidden" name="imagen" value=""/ required>
                    <input id="oldimagen" type="hidden" name="oldimagen" value=""/ required>
                    <div class="col-xs-4" style="padding-left: 4%; margin:1%;" id="my_result">
                      {{-- <img id="imagenvisitante" src=""/ style="" required> --}}
                      Esperando captura de la foto...
                    </div>
                  </div>
                  <br>
                  <div class="form-row">
                    <input type="button" class="btn btn-success" onclick="take_snapshot()" value="Tomar foto">
                  </div>
                  <br>

                <div class="form-group row row d-flex justify-content-center">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    {{ __('Crear') }}
                                </button>
                            </div>
                </div>
              </form>
              <hr>
              
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
