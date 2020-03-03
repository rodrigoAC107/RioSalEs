@extends('layouts.app2')

@section('content')
<style type="text/css">
  


.table-responsive{
  height: 250px;
  overflow-y: scroll;
}


</style>
<!-- Begin Page Content -->
        <div class="container-fluid">
              <div><a href="{{ route('empleado.buscar') }}" class="btn btn-info m-1"><i class="fas fa-chevron-left"></i></a></div>

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            
            @foreach($Empleados as $empleado)
            <p class="h3 badge badge-primary d-block d-xl-none d-lg-none" style="font-size: x-large;font-size: 3vw">Datos del Paciente <br> {{strtoupper($empleado->nombre)}} {{strtoupper($empleado->apellido)}}</p>
            <p class="h3 badge badge-primary d-none d-xl-block d-lg-block" style="font-size: x-large;font-size: 2vw">Datos del Paciente {{strtoupper($empleado->nombre)}} {{strtoupper($empleado->apellido)}}</p>
            @endforeach
          </div>
          <center id='mensaje'>
            @include('includes.guardado')
            </center>
          <div class="row">

            <div class="col-lg-6">

              <!-- Alergias -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Alergias</h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                  <table class="table table-bordered" width="100%" height="100px" cellspacing="0">
                    <thead>
                      <th>#</th>
                      <th>Legajo</th>
                      <th>Tipo</th>
                      <th>Observaciones</th>
                      @if(Auth::user()->rol_id == 1 || Auth::user()->rol_id == 2)
                      <th>Accion</th>
                      @endif
                    </thead>
                    <tbody id="alergias">
                    @if(!$Alergias->isEmpty())
                        @foreach($Alergias as $datos)
                          <td>{{ $datos->id }}</td>
                          <td>{{ $datos->legajo_id }}</td>
                          <td>{{ $datos->tipo }}</td>
                          <td>{{ $datos->observacion }}</td>
                          @if(Auth::user()->rol_id == 1 || Auth::user()->rol_id == 2)
                          <td><button class="btn btn-info text-white" data-toggle="modal" data-target="#AlergiaModal" onclick="obtenerValorAlergia({{$datos}})"><i class="far fa-edit"></i></button></td>
                          @endif
                          </tbody>
                        @endforeach
                      @else
                      <td colspan="7" align="center">No hay registros</td>
                    </tbody>
                      @endif
                  </table>
                </div>
                </div>
              </div>

              <!-- Antecedentes Familiares -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Antecedentes Familiares</h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                  <table class="table table-bordered" width="100%" height="100px" cellspacing="0">
                    <thead>
                      <th>#</th>
                      <th>Legajo</th>
                      <th>Tipo</th>
                      <th>Observaciones</th>
                      @if(Auth::user()->rol_id == 1 || Auth::user()->rol_id == 2)
                      <th>Accion</th>
                      @endif
                    </thead>
                    <tbody>
                      @if(!$Antecedentes_familiares->isEmpty())
                    @foreach($Antecedentes_familiares as $datos)
                      <td>{{ $datos->id }}</td>
                      <td>{{ $datos->legajo_id }}</td>
                      <td>{{ $datos->tipo }}</td>
                      <td>{{ $datos->observacion }}</td>
                      @if(Auth::user()->rol_id == 1 || Auth::user()->rol_id == 2)
                      <td><button class="btn btn-info text-white" data-toggle="modal" data-target="#FamiliarModal" onclick="obtenerValorFamiliar({{$datos}})"><i class="far fa-edit"></i></button></td>
                      @endif
                      </tbody>
                    @endforeach
                      @else
                      <td colspan="7" align="center">No hay registros</td>
                    </tbody>
                      @endif
                  </table>
                </div>
                </div>
              </div>

            </div>

            <div class="col-lg-6">
              <!-- Antecedentes Personales -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Antecedentes Personales</h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                  <table class="table table-bordered"  width="100%" height="100px" cellspacing="0">
                    <thead>
                      <th>#</th>
                      <th>Legajo</th>
                      <th>Tipo</th>
                      <th>Observaciones</th>
                      @if(Auth::user()->rol_id == 1 || Auth::user()->rol_id == 2)
                      <th>Accion</th>
                      @endif
                    </thead>
                    <tbody>
                    @if(!$Antecedentes_empleados->isEmpty())
                   @foreach($Antecedentes_empleados as $datos)
                      <td>{{ $datos->id }}</td>
                      <td>{{ $datos->legajo_id }}</td>
                      <td>{{ $datos->tipo }}</td>
                      <td>{{ $datos->observacion }}</td>
                      @if(Auth::user()->rol_id == 1 || Auth::user()->rol_id == 2)
                      <td><button class="btn btn-info text-white" data-toggle="modal" data-target="#EmpleadoModal" onclick="obtenerValorEmpleado({{$datos}})"><i class="far fa-edit"></i></button></td>
                      @endif
                    </tbody>
                    @endforeach
                      @else
                      <td colspan="7" align="center">No hay registros</td>
                      </tbody>
                      @endif
                  </table>
                </div>
                </div>
              </div>

              <!-- Dietas -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Dietas</h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                  <table class="table table-bordered" width="100%" height="100px" cellspacing="0">
                    <thead>
                      <th>#</th>
                      <th>Legajo</th>
                      <th>Tipo N1</th>
                      <th>Tipo N2</th>
                      <th>Come</th>
                      <th>No come</th>
                      @if(Auth::user()->rol_id == 1 || Auth::user()->rol_id == 2)
                      <th>Accion</th>
                      @endif
                    </thead>
                    <tbody>
                    @if(!$Dietas->isEmpty())
                   @foreach($Dietas as $datos)
                      <td>{{ $datos->id }}</td>
                      <td>{{ $datos->legajo_id }}</td>
                      <td>{{ $datos->tipo_1 }}</td>
                      <td>{{ $datos->tipo_2 }}</td>
                      <td>{{ $datos->comidas_permitidas }}</td>
                      <td>{{ $datos->comidas_no_permitidas }}</td>
                      @if(Auth::user()->rol_id == 1 || Auth::user()->rol_id == 2)
                      <td><button class="btn btn-info text-white" data-toggle="modal" data-target="#DietaModal" onclick="obtenerValorDieta({{$datos}})"><i class="far fa-edit"></i></button></td>
                      @endif
                      </tbody>
                    @endforeach
                      @else
                      <td colspan="7" align="center">No hay registros</td>
                      </tbody>
                      @endif
                  </table>
                </div>
                </div>
              </div>          

            </div>

            <div class="col-lg-6">
              <!-- Habitos -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Habitos</h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                  <table class="table table-bordered" width="100%" height="100px" cellspacing="0">
                    <thead>
                      <th>#</th>
                      <th>Legajo</th>
                      <th>Observacion</th>
                      @if(Auth::user()->rol_id == 1 || Auth::user()->rol_id == 2)
                      <th>Accion</th>
                      @endif
                    </thead>
                    <tbody>
                    @if(!$Habitos->isEmpty())
                   @foreach($Habitos as $datos)
                      <td>{{ $datos->id }}</td>
                      <td>{{ $datos->legajo_id }}</td>
                      <td>{{ $datos->observacion }}</td>
                      @if(Auth::user()->rol_id == 1 || Auth::user()->rol_id == 2)
                      <td><button class="btn btn-info text-white" data-toggle="modal" data-target="#HabitoModal" onclick="obtenerValorHabito({{$datos}})"><i class="far fa-edit"></i></button></td>
                      @endif
                    </tbody>
                    @endforeach
                      @else
                      <td colspan="7" align="center">No hay registros</td>
                      </tbody>
                      @endif
                  </table>
                </div>
                </div>
              </div>

            </div>

            <div class="col-lg-6">
              <!-- Estudios -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Estudios</h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                  <table class="table table-bordered" width="100%" height="100px" cellspacing="0">
                    <thead>
                      <th>#</th>
                      <th>Legajo</th>
                      <th>Nombre</th>
                      <th>Tipo</th>
                      <th>Observacion</th>
                      @if(Auth::user()->rol_id == 1 || Auth::user()->rol_id == 2)
                      <th>Accion</th>
                      @endif
                    </thead>
                    <tbody>
                    @if(!$Estudios->isEmpty())
                   @foreach($Estudios as $datos)
                      <td>{{ $datos->id }}</td>
                      <td>{{ $datos->legajo_id }}</td>
                      <td>{{ $datos->nombre }}</td>
                      <td>{{ $datos->tipo }}</td>
                      <td>{{ $datos->observacion }}</td>
                      @if(Auth::user()->rol_id == 1 || Auth::user()->rol_id == 2)
                      <td>
                        <a href="{{route('estudio.ver.descarga', $datos->nombre)}}" class="btn btn-primary m-1" target="_blank"><i class="far fa-eye"></i></button>
                        <a href="{{route('estudio.descarga', $datos->nombre)}}" class="btn btn-secondary m-1"><i class="fas fa-download"></i></button>
                      </td>
                      @endif
                      </tbody>
                    @endforeach
                      @else
                      <td colspan="7" align="center">No hay registros</td>
                      </tbody>
                      @endif
                  </table>
                </div>
                </div>
              </div> 
              
            </div>

            

          </div>

        </div>

    {{-- LOS MODALES PARA EDITAR --}}
    @include('empleados.modal.modalAlergia')
    @include('empleados.modal.modalDieta')
    @include('empleados.modal.modalEmpleado')
    @include('empleados.modal.modalFamiliar')
    @include('empleados.modal.modalHabito')
    
    {{-- INCLUDES DE JAVASCRIPT --}}
    <script type="text/javascript" src="{{asset('js/script_empleados/alergia.js')}}"></script>

        <!-- /.container-fluid -->
@endsection
    

