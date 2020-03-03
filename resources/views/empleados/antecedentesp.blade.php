@extends('empleados.index')



@section('contenido')
<style type="text/css">
  
#volver{
   color:white;
}

#botonStep2{
  color:white;
}

</style>

{{-- <div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5"> --}}
      <div class="card-body">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Agregar Antecendetes del Paciente</h1>
              </div>


              <div class="justify-content-center text-center text-uppercase py-1 d-block d-xl-none d-lg-none" style="font-size: x-large;font-size: 3vw">
              @include('includes.error')
              @include('includes.guardado')
            </div>
            <div class="justify-content-center text-center text-uppercase py-1 d-none d-xl-block d-lg-block" style="font-size: x-large;font-size: 2vw">
              @include('includes.error')
              @include('includes.guardado')
            </div>
              <form class="user" method="POST" action="{{route('antecedentePersonal.store')}}" aria-label="{{ __('Antecedentes del Empleado') }}" autocomplete="off">
               @csrf
                
                
               
                <div class="form-group row" id="stepper1">
                	<div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('legajo_id') ? ' is-invalid' : '' }}" name="legajo_id" value="{{ old('legajo_id') }}" id="legajo_id" placeholder="Legajo">
                    @if ($errors->has('legajo_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('legajo_id') }}</strong>
                                    </span>
                    @endif
                  </div>

                 
                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('tipo') ? ' is-invalid' : '' }}" name="tipo" value="{{ old('tipo') }}" id="tipo" placeholder="Tipo de Antecedente">
                    @if ($errors->has('tipo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tipo') }}</strong>
                                    </span>
                    @endif
                  </div>

                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('observacion') ? ' is-invalid' : '' }}" name="observacion" value="{{ old('observacion') }}" id="observacion" placeholder="Observacion">
                    @if ($errors->has('observacion'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('observacion') }}</strong>
                                    </span>
                    @endif
                  </div>
              </div>
               <div class="form-group row" id="stepper2">
                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('enfermedad') ? ' is-invalid' : '' }}" name="enfermedad" value="{{ old('enfermedad') }}" id="enfermedad" placeholder="Enfermedad" readonly>
                    @if ($errors->has('enfermedad'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('enfermedad') }}</strong>
                                    </span>
                    @endif
                  </div>
                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('area') ? ' is-invalid' : '' }}" name="area" value="{{ old('area') }}" id="area" placeholder="Area" readonly>
                    @if ($errors->has('area'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('area') }}</strong>
                                    </span>
                    @endif
                  </div>
                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <div class="input-group">
                      <input type="text" class="form-control form-control-user{{ $errors->has('riesgo') ? ' is-invalid' : '' }}" name="riesgo" value=""  id="riesgo" placeholder="Riesgo" title="Porcentaje">
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
              <div class="form-group row" id="pregunta">
                <div class="col-sm-8 mb-3 mb-sm-0">
                  <div class="radio justify-content-center">
                    <label class="h6 text-gray-900 mb-3 inline">El antecedente que está guardando, ¿Se trata de una enfermedad?</label>
                    <label class="radio-inline "><input type="radio" name="optradio" id="optradioTrue">Si</label>
                    <label class="radio-inline"><input type="radio" name="optradio" id="optradioFalse">No</label>
                  </div>
                </div>
              </div>
               
                <div class="form-group row d-flex justify-content-center">
                            <div class="col-md-4" >
                                <a class="btn btn-primary btn-user btn-block"  id="botonStep1" href="{{route('antecedentePersonal.legajoArea')}}">
                                    {{ __('SIGUIENTE') }}
                                </a>
                                <a class="btn btn-primary btn-user btn-block" id="botonStep2">
                                    {{ __('SIGUIENTE') }}
                                </a>
                                <a class="btn btn-primary btn-user btn-block" id="volver">
                                    {{ __('VOLVER') }}
                                </a>
                                 <button type="submit" class="btn btn-primary btn-user btn-block" id="guardar">
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
<script type="text/javascript" src="{{asset('js/script_empleados/jquery-3.4.1.min.js')}}"></script>

<script type="text/javascript">

 $('#botonStep2').hide();
 $('#volver').hide();
 $('#stepper2').hide();
 $('#guardar').hide();

$(document).ready(function(){
  $('#botonStep2').hide();
 $('#volver').hide();
 $('#stepper2').hide();
 $('#guardar').hide();
});

$('#volver').click(function() {
  $('#stepper2').hide();
  $('#stepper1').show();
  $('#pregunta').show();
  $('#botonStep1').show();
  $('#botonStep2').hide();
  $('#volver').hide();
  $('#guardar').hide();
  $('#enfermedad').removeAttr('disabled');
  $('#area').removeAttr('disabled');
  $('#riesgo').removeAttr('disabled');
  $('#riesgo').removeAttr('value');

});
$('#botonStep2').click(function() {
       $('#stepper1').show();
       $('#stepper2').show();
       $('#botonStep2').hide();
       $('#volver').show();
       $('#guardar').show();
       $('#legajo_id').val(legajo);
       $('#observacion').val(observacion);

});


$('#botonStep1').click(function(e) {
      e.preventDefault();
  
    var radioButTrat = $('#optradioTrue');
    var legajo=$('#legajo_id').val();
    var tipo=$('#tipo').val();
    var observacion=$('#observacion').val();
    var url = $('#botonStep1').attr('href');
    var dato=$('#legajo_id').val();


       
        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            dataType: 'json',
            data:{legajo_id:dato},
            success:function(resultado){
              $('#area').val(resultado.area_trabajo)
              

            },
            error:function(){
              console.log('error');
            }
           
          });
          
     
      
        
    for (var i=0; i<radioButTrat.length; i++) {

    if (radioButTrat[i].checked == true) {
       $('#stepper1').hide();
       $('#pregunta').hide();
       $('#botonStep1').hide();
       $('#botonStep2').show();
       $('#volver').show();
       $('#stepper2').show();
       $('#enfermedad').val(tipo);

      
      }else{
        $('#stepper1').show();
        // $('#stepper2').show();
        $('#pregunta').hide();
        
        $('#enfermedad').attr('disabled','disabled');
        $('#area').attr('disabled','disabled');
        $('#riesgo').attr('disabled','disabled');

        $('#guardar').show();
        $('#botonStep1').hide();
        $('#volver').show();
        
      }

    }
  
  
  

});


</script>




@endsection