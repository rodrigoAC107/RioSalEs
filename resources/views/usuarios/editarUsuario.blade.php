@extends('layouts.app2')



@section('content')
<div class="card shadow mb-4">   
<div class="card-body">
              <div><a href="{{ URL::previous() }}" class="btn btn-info m-1"><i class="fas fa-chevron-left"></i></a></div>

        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            @foreach($usuarios as $usuario)

           <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Editar Usuario</h1>
              </div>
              <div class="d-flex justify-content-center text-center text-uppercase pb-3">
              @include('includes.guardado')
              </div>
              <form class="user" method="POST" action="{{route('usuarios.update',$usuario->id)}}"  autocomplete="off">
                {{method_field('PUT')}}
                @csrf
                {{-- PRIMERA FILA --}}
                <div class="form-group row">
                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" required autofocus value="{{$usuario->nombre}}">
                    @if ($errors->has('nombre'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                    @endif
                  </div>
                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('apellido') ? ' is-invalid' : '' }}" name="apellido" value="{{$usuario->apellido}}">
                    @if ($errors->has('apellido'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('apellido') }}</strong>
                                    </span>
                    @endif
                  </div>

                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{$usuario->email}}"  readonly>
                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                  </div>

                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <select id="rol_id" name="rol_id" class="form-control form-control-user{{ $errors->has('rol_id') ? ' is-invalid' : '' }}"  required autofocus style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px">
                                  <option selected value="{{$usuario->rol_id}}">{{$usuario->roles->nombre}}</option>
                                  @if($usuario->roles->nombre=="Administrador")
                                  <option value="2">Medico</option>
                                  <option value="3">Enfermero</option>
                                  @elseif($usuario->roles->nombre=="Medico")
                                  <option value="1">Administrador</option>
                                  <option value="3">Enfermero</option>
                                  @elseif($usuario->roles->nombre=="Enfermero")
                                  <option value="1">Administrador</option>
                                  <option value="2">Medico</option>
                                  @endif
                                 
                      </select>
                    @if ($errors->has('rol_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rol_id') }}</strong>
                                    </span>
                    @endif
                  </div>
                </div>
                {{-- SEGUNDA FILA --}}
                <div class="form-group row">
                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('dni') ? ' is-invalid' : '' }}" name="dni" value="{{$usuario->dni}}">
                    @if ($errors->has('dni'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dni') }}</strong>
                                    </span>
                    @endif
                  </div>
                </div>
                <div class="form-row">
                <div class="col-xs-4 mt-2 ml-2" id="my_camera" style="width:200px; height:240px;"></div>
                <input id="imagen" type="hidden" name="imagen" value=""/ required>
                <input id="oldimagen" type="hidden" name="oldimagen" value=""/ required>
                <div class="col-xs-4 mx-5 mt-3" id="my_result">
                  {{-- <img id="imagenvisitante" src=""/ style="" required> --}}
                    Esperando captura de la foto...
                </div>
                <div class="col-xs-4 mt-3 ml-5">
                  @if($usuario->imagen)
                  <p>Foto actual:</p>
                  <img src="{{ asset('storage/perfilUsuario/' . $usuario->imagen)  }}" class="rounded" style="width:175px; height:160px;">
                  @else
                  <p>No tiene foto actual</p>
                  @endif
                </div>
              </div>
              <br>
              <div class="row">
                <input type="button" class="btn btn-success" onclick="take_snapshot()" value="Tomar foto">
              </div>
              <br>
                <div class="form-group row d-flex justify-content-center">
                            <div class="col-md-2">
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