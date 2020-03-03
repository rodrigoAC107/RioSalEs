@extends('layouts.app2')
@section('content')

    <div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Buscar Donación</h1>
              </div>
              
              <form class="user" method="POST" id="form" action="{{route('donacion.store')}}" autocomplete="off" onKeypress="if(event.keyCode == 13) event.returnValue = false;">
                @csrf
                <div class="form-group row">
                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('legajo') ? ' is-invalid' : '' }}" name="legajo" value="{{ old('legajo') }}" required autofocus id="legajo" placeholder="Legajo">
                  </div>
                  <div class="col-sm-3 mb-3 mb-sm-0">
                      <input type="submit" class="btn btn-primary btn-user btn-block text-white" value="BUSCAR">
                 </div>
                </div>
              </form>

              <hr>

                <div class="row">
                          <div class="col-lg-12">
                              <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Agregar Donación</h1>
                              </div>
                              @foreach($legajo as $Legajo)
                              <form class="user" method="POST" id="formTabla" action="{{route('donacion.update', $Legajo->legajo)}}" autocomplete="off">
                                {{method_field('PUT')}}
                                @csrf
                                <div class="form-group row">
                                  <div class="col-sm-3 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user{{ $errors->has('legajo') ? ' is-invalid' : '' }}" name="legajo" value="{{strtoupper($Legajo->legajo)}}" required id="legajo_id" readonly>
                                  </div>
                                  <div class="col-sm-5 mb-6 mb-sm-0">
                                    @if($donacion->isEmpty())
                                      <select id="numeroDonacion" name="numeroDonacion" class="form-control form-control-user{{ $errors->has('numeroDonacion') ? ' is-invalid' : '' }}" value="{{ old('numeroDonacion') }}" required autofocus style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px" >
                                          <option selected disabled>N° de Donación</option>
                                          <option value="Primera" >Primera</option>
                                      </select>
                                    @else
                                    @foreach($donacion as $dona)
                                      <select id="numeroDonacion" name="numeroDonacion" class="form-control form-control-user{{ $errors->has('numeroDonacion') ? ' is-invalid' : '' }}" value="{{ old('numeroDonacion') }}" required autofocus style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px" >
                                                  <option selected disabled>N° de Donación</option>
                                                  @if($dona->fecha_1 == NULL && $dona->isEmpty())
                                                  <option value="Primera" >Primera</option>
                                                  @elseif($dona->fecha_2 == NULL)
                                                  <option value="Segunda" >Segunda</option>
                                                  @elseif($dona->fecha_3 == NULL)
                                                  <option value="Tercera" >Tercera</option>
                                                  @else
                                                  <option disabled>Ya se realizaron las tres donaciones anuales</option>
                                                  @endif
                                      </select>
                                    @endforeach
                                    @endif
                                  </div>
                                  <div class="col-sm-3 mb-3 mb-sm-0">
                                                <input type="submit" class="btn btn-primary btn-user btn-block text-white" value="GUARDAR">
                                 </div>
                                 @include('includes.guardado')
                               </div>
                              </form>
                              @endforeach
                              
                        </div>
                </div>

              
          </div>
        </div>
      </div>
    </div>

    

  </div>




    
@stop