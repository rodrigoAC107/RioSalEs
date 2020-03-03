@extends('layouts.app2')


@section('content')


          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Programa de Vacunacion para {{$area}}</h6>
            </div>
            <div class="d-flex justify-content-center text-center text-uppercase pb-3 py-3">
              @include('includes.guardado')
              @include('includes.error')
              </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Legajo</th>
                      <th>Apellido</th>
                      <th>Nombre</th>
                      <th>Telefono</th>
                      <th>Accion</th>
                    </tr>
                  </thead>
                  <tbody>
                     @foreach($empleados as $empleado)
                     <tr>
                        <td>{{$empleado->legajo}}</td>
                        <td>{{ucwords($empleado->apellido)}}</td>
                        <td>{{ucwords($empleado->nombre)}}</td>
                        <td>{{$empleado->telefono}}</td>
                        <td class="text-center"><button class="btn btn-info m-1"  data-toggle="modal" data-target="#VacunacionModal" title="Agregar Vacuna" onclick="obtenerValores({{$empleado}})"><i class="fas fa-syringe"></i></button></td>
                     </tr>
                   @endforeach
                  </tbody>
                </table>
                <input type="hidden" id="fechaPrograma" name="fechaPrograma" value="{{date('yy-m-d',strtotime($fechaPrograma))}}">{{date('yy-m-d',strtotime($fechaPrograma))}}</input>
                <input type="hidden" id="vacunaPrograma" name="vacunaPrograma" value="{{$vacuna}}"></input>
                <input type="hidden" id="DosisPrograma" name="DosisPrograma" value="{{$dosis}}"></input>
                <input type="hidden" id="numeroPrograma" name="numeroPrograma" value={{$numeroPrograma}}></input>
              </div>
            </div>
          </div>


@include('programaVacunacion.modalPrograma')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
  function obtenerValores(empleado) {
    var legajo=document.getElementById('legajo');
    var fecha=document.getElementById('fecha');
    var vacuna=document.getElementById('vacuna');
    var dosis=document.getElementById('dosis');
    var numero=document.getElementById('numero');

    var fechaPrograma=document.getElementById('fechaPrograma');
    var vacunaPrograma=document.getElementById('vacunaPrograma');
    var dosisPrograma=document.getElementById('DosisPrograma');
    var numeroPrograma=document.getElementById('numeroPrograma');
    legajo.value=empleado['legajo'];
    fecha.value=fechaPrograma.value;
    vacuna.value=vacunaPrograma.value;
    dosis.value=dosisPrograma.value;
    numero.value=numeroPrograma.value;

    console.log(numeroPrograma.value);
    

  }
  
</script>


@endsection
