@extends('layouts.app2')



@section('content')

<div class="card">
<div class="card-head">
<div class="container">
<div class="container-fluid">

<div class="card-body">
  <div><a href="{{ URL::previous() }}" class="btn btn-info m-1"><i class="fas fa-chevron-left"></i></a></div>
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
              <div class="text-center">
                <center>
                @include('includes.guardado')
                </center>
                <h1 class="h4 text-gray-900 mb-4">Editar Riesgo</h1>
              </div>

              @foreach($editarEnfermedad as $enfermedad)
              <form class="user" method="POST" action="{{route('informe-enfermedad.update',$enfermedad->id)}}" aria-label="{{ __('Editar Riesgo') }}" autocomplete="off">
              	 {{method_field('PUT')}}
                @csrf
                {{-- PRIMERA FILA --}}
                <div class="form-group row">
                	<div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('area') ? ' is-invalid' : '' }}" name="area" value="{{$enfermedad->area}}" id="area" placeholder="Area" readonly>
                    @if ($errors->has('area'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('area') }}</strong>
                                    </span>
                    @endif
                  </div>
                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('enfermedad') ? ' is-invalid' : '' }}" name="enfermedad" value="{{$enfermedad->enfermedad}}" id="enfermedad" placeholder="Enfermedad" readonly>
                    @if ($errors->has('enfermedad'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('enfermedad') }}</strong>
                                    </span>
                    @endif
                  </div>
                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <div class="input-group">
                      <input type="text" class="form-control form-control-user{{ $errors->has('riesgo') ? ' is-invalid' : '' }}" name="riesgo" value="{{$enfermedad->riesgo}}"  id="riesgo" placeholder="Riesgo" title="Porcentaje" autofocus>
                      <div class="input-group-prepend">
                        <span class="input-group-text">%</span>
                      </div> 
                      @if ($errors->has('riesgo'))
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('riesgo') }}</strong>
                                      </span>
                      @endif
                    </div>
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
              @endforeach
               
          </div>
        </div>
      </div>
</div>
</div>
</div>
</div>








@endsection