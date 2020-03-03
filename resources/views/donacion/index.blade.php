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
              <form class="user" method="POST" action="{{route('donacion.store')}}" autocomplete="off">
                @csrf
                <div class="form-group row">
                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('legajo') ? ' is-invalid' : '' }}" name="legajo" value="{{ old('legajo') }}" required autofocus id="legajo" placeholder="Legajo">
                  </div>
                  <div class="col-sm-3 mb-3 mb-sm-0">
                      <input type="submit" class="btn btn-primary btn-user btn-block text-white" value="BUSCAR">
                 </div>
                </div>
                 @include('includes.error')
                 @include('includes.guardado')
              </form>
                            
          </div>
        </div>
      </div>
    </div>

    

  </div>

    
@stop
