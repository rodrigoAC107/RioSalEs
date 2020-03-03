@extends('empleados.index')



@section('contenido')
<div class="card-body">
<div class="row">
  <div class="col-lg-12">
        <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Agregar Informacion sobre Dietas</h1>
                </div>
              <div class="justify-content-center text-center text-uppercase py-1 d-block d-xl-none d-lg-none" style="font-size: x-large;font-size: 3vw">
                @include('includes.error')
                @include('includes.guardado')
              </div>
              <div class="justify-content-center text-center text-uppercase py-1 d-none d-xl-block d-lg-block" style="font-size: x-large;font-size: 2vw">
                @include('includes.error')
                @include('includes.guardado')
              </div>
        <form class="user" id="form" method="POST" action="{{route('dieta.mostrarComida')}}" aria-label="{{ __('Informacion de Dietas') }}" autocomplete="off">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <div class="form-group row">
            <div class="col-sm-3 mb-3 mb-sm-0">
              <div class="input-group">
                                <select id="tipo" name="tipo" class="form-control form-control-user{{ $errors->has('tipo') ? ' is-invalid' : '' }}" value="{{ old('tipo') }}" style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px" action="">
                                            <option selected disabled>Tipo de Dieta</option>
                                            @foreach($comidas as $comida)
                                            <option>{{$comida->tipo}}</option>
                                            @endforeach
                                            
                                            
                                </select>
                                @if ($errors->has('tipo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tipo') }}</strong>
                                    </span>
                                @endif

              <div class="input-group-prepend">       
                                             
                <button type="button" id="boton" class="tn btn-primary btn-user btn-block" title="Buscar comidas" ><i class="fas fa-search"></i></button>
              
              </div>
                                                      
              </div>
            </div>
            

        </div>
        </form>
        <div id="respuesta">
  <form class="user" method="POST" action="{{route('dieta.store')}}" aria-label="{{ __('Informacion de Dietas') }}" autocomplete="off">

                @csrf
                {{-- PRIMERA FILA --}}
                <div class="form-group row">
                  <div  id="oculto"class="col-sm-3 mb-3 mb-sm-0">
              
            <select id="tipo1" name="tipo1" class="form-control form-control-user{{ $errors->has('tipo1') ? ' is-invalid' : '' }}" value="{{ old('tipo1') }}" style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px" action="">
                        <option selected disabled>Tipo de Dieta</option>
                          @foreach($comidas as $comida)
                        <option>{{$comida->tipo}}</option>
                          @endforeach
                                            
                                            
                                </select>
                  @if ($errors->has('tipo'))
                       <span class="invalid-feedback" role="alert">
                           <strong>{{ $errors->first('tipo') }}</strong>
                        </span>
                 @endif 
          </div>
                  
                   <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('legajo_id') ? ' is-invalid' : '' }}" name="legajo_id" value="" id="exampleLastName" placeholder="Legajo" required>
                    @if ($errors->has('legajo_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('legajo_id') }}</strong>
                                    </span>
                    @endif
                  </div>
                  <div class="col-sm-4 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('come') ? ' is-invalid' : '' }}" name="come" value="${resultado.come}" id="come" placeholder="Comidas permitidas" readonly>
                    @if ($errors->has('come'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('come') }}</strong>
                                    </span>
                    @endif
                  </div>
              </div>
              {{-- SEGUNDA FILA --}}
              <div class="form-group row">
                   <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('no_come') ? ' is-invalid' : '' }}" name="no_come" value="{{ old('no_come') }}" id="no_come" placeholder="Comidas no permitidas" readonly>
                    @if ($errors->has('no_come'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('no_come') }}</strong>
                                    </span>
                    @endif
                  </div> 
              </div>
              <div class="form-group row">
                   <div class="col-sm-1 mb-0 mb-sm-0"onclick="mostrar()">
                       <button type="button" id="boton" class="tn btn-primary btn-user btn-block" title="Agregar Otro Tipo de Dieta" ><i class="far fa-plus-square"></i></button>
                    </div>
              </div>
              <div id="prueba" class="form-group row">
                <div class="col-sm-3 mb-3 mb-sm-0">
                    <div class="input-group">
                    <select id="tipo2" name="tipo2" class="form-control form-control-user{{ $errors->has('tipo2') ? ' is-invalid' : '' }}" value="{{ old('tipo2') }}"   style="font-size: 0.8rem; border-radius: 10rem; padding: 0.5rem 1rem; height: 50px">
                                <option selected disabled>Tipo de Dieta</option>
                                @foreach($comidas as $comida)
                                <option>{{$comida->tipo}}</option>
                                @endforeach
                                
                    </select>
                    @if ($errors->has('tipo2'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('tipo2') }}</strong>
                        </span>
                    @endif
                        <div class="input-group-prepend">       
                                             
                          <button type="button" id="boton2" class="tn btn-primary btn-user btn-block" title="Buscar comidas"><i class="fas fa-search" ></i></button>
              
                        </div>
                    </div>
                  </div>

                  <div class="col-sm-6 mb-3 mb-sm-3">
                    <input type="text" class="form-control form-control-user{{ $errors->has('come2') ? ' is-invalid' : '' }}" name="come2" value="{{ old('come2') }}" id="come2" placeholder="Comidas permitidas" readonly>
                    @if ($errors->has('come2'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('come2') }}</strong>
                                    </span>
                    @endif
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('no_come2') ? ' is-invalid' : '' }}" name="no_come2" value="{{ old('no_come2') }}" id="no_come2" placeholder="Comidas no permitidas" readonly>
                    @if ($errors->has('no_come2'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('no_come2') }}</strong>
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

<script type="text/javascript" src="{{asset('js/script_empleados/jquery-3.4.1.min.js')}}"></script>

<script type="text/javascript">
$('#respuesta').hide();
  $('#prueba').hide();
$(document).ready(function(){
  $('#respuesta').hide();
  $('#prueba').hide();
});


$('#boton').click(function(e) {
        e.preventDefault();
        var dato = $('#tipo').val();

        var url = $('#form').attr('action');



        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            dataType: 'json',
            data:{tipo:dato},
            success:function(resultado){
              console.log(resultado);
              $('#respuesta').show();
              $('#come').val(resultado.come);
              $('#no_come').val(resultado.no_come);
              $('#tipo1').val(dato);
              $('#come').dblclick(function() {
                $('#come').removeAttr('readonly');
              });
              $('#no_come').dblclick(function() {
                $('#no_come').removeAttr('readonly');
              });
              $('#oculto').hide();

            }
           
          });
          
     
        });

var clic= 1 ;

function mostrar(){
  if (clic==1) {
      $('#prueba').show();
      clic++;
      }else{
        $('#prueba').hide();
        clic=1;

      }
  }


  $('#boton2').click(function(e) {
        e.preventDefault();
        var dato = $('#tipo2').val();

        var url = $('#form').attr('action');



        $.ajax({
            url: url,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: 'POST',
            dataType: 'json',
            data:{tipo:dato},
            success:function(resultado){
              
              $('#respuesta').show();
              $('#come2').val(resultado.come);
              $('#no_come2').val(resultado.no_come);
              $('#come2').dblclick(function() {
                $('#come2').removeAttr('readonly');
              });
              $('#no_come2').dblclick(function() {
                $('#no_come2').removeAttr('readonly');
              });
            }
           
          });
          
     
        });





</script>
@endsection