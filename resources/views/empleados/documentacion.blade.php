@extends('empleados.index')



@section('contenido')

{{-- <div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5"> --}}
      <div class="card-body">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Agregar Estudios</h1>
              </div>
              <div class="text-center text-uppercase">
                 @include('includes.guardado')
                 @include('includes.error')
              </div>

             
              <form class="user" method="POST" action="{{route('documentacion.store')}}" aria-label="{{ __('Informacion de Estudios') }}" autocomplete="off" enctype="multipart/form-data">

                @csrf
                {{-- PRIMERA FILA --}}
                <div class="form-group row m-auto">
                    <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('legajo_id') ? ' is-invalid' : '' }}" name="legajo_id" value="{{ old('legajo_id') }}" placeholder="Legajo">
                    @if ($errors->has('legajo_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('legajo_id') }}</strong>
                                    </span>
                    @endif
                  </div>
                  <div class="col-sm-4 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('tipo') ? ' is-invalid' : '' }}" name="tipo" value="{{ old('tipo') }}" placeholder="Tipo de estudio">
                    @if ($errors->has('tipo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tipo') }}</strong>
                                    </span>
                    @endif
                  </div>
                </div>
                <br><br>
                <div class="form-group row m-auto">
                  <div class="col-sm-4 mb-3 mb-sm-5">
                    <input type="text" class="form-control form-control-user{{ $errors->has('observacion') ? ' is-invalid' : '' }}" name="observacion" value="{{ old('observacion') }}" placeholder="Observacion">
                    @if ($errors->has('observacion'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('observacion') }}</strong>
                                    </span>
                    @endif
                  </div>

                  <div class=" form-group col-sm-4 mb-3 mb-sm-5 pt-2">
                    <input type="file" {{ $errors->has('estudio') ? ' is-invalid' : '' }} name="estudio" value="{{ old('estudio') }}" placeholder="estudio"  accept="application/pdf,image/peg,/image/jpg,image/jpeng,image/png">
                    @if ($errors->has('estudio'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('estudio') }}</strong>
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
           </div>
          </div>

        </div>




@endsection