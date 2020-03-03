@extends('empleados.index')



@section('contenido')

{{-- <div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5"> --}}
      <div class="card-body">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Agregar Informacion sobre Alergias</h1>
              </div>
            <div class="justify-content-center text-center text-uppercase py-1 d-block d-xl-none d-lg-none" style="font-size: x-large;font-size: 3vw">
              @include('includes.error')
              @include('includes.guardado')
            </div>
            <div class="justify-content-center text-center text-uppercase py-1 d-none d-xl-block d-lg-block" style="font-size: x-large;font-size: 2vw">
              @include('includes.error')
              @include('includes.guardado')
            </div>

            {{--   <div class="d-flex justify-content-center text-center text-uppercase pb-3">
              @include('includes.error')
              @include('includes.guardado')
              </div> --}}
              <form class="user" method="POST" action="{{route('alergia.store')}}" aria-label="{{ __('Informacion de Alergias') }}" autocomplete="off">

                @csrf
                {{-- PRIMERA FILA --}}
                <div class="form-group row">
                    <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('legajo_id') ? ' is-invalid' : '' }}" name="legajo_id" value="{{ old('legajo_id') }}" id="exampleLastName" placeholder="Legajo">
                    @if ($errors->has('legajo_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('legajo_id') }}</strong>
                                    </span>
                    @endif
                  </div>
                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('tipo') ? ' is-invalid' : '' }}" name="tipo" value="{{ old('tipo') }}" id="exampleLastName" placeholder="Tipo de Alergia">
                    @if ($errors->has('tipo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tipo') }}</strong>
                                    </span>
                    @endif
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-5">
                    <input type="text" class="form-control form-control-user{{ $errors->has('observacion') ? ' is-invalid' : '' }}" name="observacion" value="{{ old('observacion') }}" id="exampleLastName" placeholder="Observacion">
                    @if ($errors->has('observacion'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('observacion') }}</strong>
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
    </div>

  </div>




@endsection