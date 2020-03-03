@extends('consultas.imc')


@section('resultado')
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body">
        
        <!-- Nested Row within Card Body -->
       <div class="row">
          <div class="col-lg-12">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Datos del Paciente</h1>
              </div>
              @foreach($legajo as $leg)
              <div class="row">
                <div class="form-group row">

                  <div class="col-sm-3 mb-3 mb-sm-0">
                  	<label for="legajo" class="text-center">Legajo</label>
                    <input type="text" class="form-control form-control-user{{ $errors->has('legajo') ? ' is-invalid' : '' }}" name="legajo" value="{{$leg->legajo_id}}" required autofocus id="legajo_id" readonly>
                  </div>
                   <div class="col-sm-3 mb-3 mb-sm-0">
                   	<label for="peso">Peso</label>
                    <div class="input-group">
                    <input type="text" class="form-control form-control-user{{ $errors->has('peso') ? ' is-invalid' : '' }}" name="peso" value="{{$leg->peso}}" required autofocus id="peso" readonly>
                      <div class="input-group-prepend">
                        <span class="input-group-text">Kg.</span>
                      </div> 
                    </div>
                  </div>
                   <div class="col-sm-3 mb-3 mb-sm-0">
                   	<label for="estatura">Estatura</label>
                    <div class="input-group">
                    <input type="text" class="form-control form-control-user{{ $errors->has('estatura') ? ' is-invalid' : '' }}" name="estatura" value="{{$leg->estatura}}" required autofocus id="estatura" readonly>
                      <div class="input-group-prepend">
                        <span class="input-group-text">Cm.</span>
                      </div> 
                    </div>
                  </div>
                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <label for="calculo_imc">IMC</label>
                    <input type="text" class="form-control form-control-user{{ $errors->has('calculo_imc') ? ' is-invalid' : '' }}" name="calculo_imc" value="{{$leg->calculo_imc}}" required autofocus id="calculo_imc" readonly>
                  </div>
               </div>
               
              
                <div class="alert {{$leg->color}}" role="alert">
                  <label>El paciente posee el siguiente estado: {{$leg->estado}}</label>
                </div>
                
                <div class="col-sm-3 mb-3 mb-sm-0">
                      <button id="calcular" class="btn btn-primary btn-user btn-block text-white" data-toggle="modal" data-target="#ImcModal">NUEVO CALCULO</button>
                 </div>  
                @endforeach
                         
        	  </div>
            <hr>
            <hr> 
            <div id="row"> 
                <div class="chart-area text-center" id="curve_chart" >
                        
                </div>
            </div>
            

		      </div>
        </div>        
      </div>
    </div>
</div>
  

@include('consultas.nuevoCalculo')

@endsection

