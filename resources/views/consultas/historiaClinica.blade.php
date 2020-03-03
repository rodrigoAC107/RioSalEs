@extends('layouts.app2')




@section('content')


<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Historia Clinica</h1>
              </div>
                 <div class="justify-content-center text-center text-uppercase py-1 d-block d-xl-none d-lg-none" style="font-size: x-large;font-size: 3vw">
                @include('includes.error')
                @include('includes.guardado')
                </div>
              <div class="justify-content-center text-center text-uppercase py-1 d-none d-xl-block d-lg-block" style="font-size: x-large;font-size: 2vw">
                @include('includes.error')
                @include('includes.guardado')
              </div>
              <form class="user" method="POST" id="form" action="{{route('consultas.historiaParticular')}}" autocomplete="on" {{-- onKeypress="if(event.keyCode == 13) event.returnValue = false;" --}}>
                @csrf
                <div class="form-group row">
                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('legajo_id') ? ' is-invalid' : '' }}" name="legajo_id" value="{{ old('legajo_id') }}" required autofocus id="legajo_id" placeholder="Legajo">
                    @if ($errors->has('legajo_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('legajo_id') }}</strong>
                                    </span>
                    @endif
                  </div>
                  <div class="col-sm-3 mb-3 mb-sm-0">
                      <button type="submit" class="btn btn-primary btn-user btn-block">
                                    {{ __('BUSCAR') }}
                                </button>
                 </div>
                </div>
              </form>

              
              
          </div>
        </div>
      </div>

    </div>
  </div>


@yield('resultado')
@endsection