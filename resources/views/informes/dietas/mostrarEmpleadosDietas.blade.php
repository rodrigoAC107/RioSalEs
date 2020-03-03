@extends('layouts.app2')



@section('content')
<!-- DataTales Example -->
          <div class="card shadow mb-4">


            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Dietas de todos los Pacientes</h6>
            </div>
            <div class="d-flex justify-content-center text-center text-uppercase pb-3 py-3">
              @include('includes.guardado')
              </div>
            <div class="card-body">
              <div><a href="{{ URL::previous() }}" class="btn btn-info m-1"><i class="fas fa-chevron-left"></i></a></div>
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Legajo</th>
                      <th>Apellido</th>
                      <th>Nombre</th>
                      <th>Área</th>
                      <th>Tipo Dieta</th>
                    </tr>
                  </thead>
                  <tbody>
                     @foreach($empleados as $empleado)
                     <tr>
                        <td>{{$empleado->legajo}}</td>
                        <td>{{ucwords($empleado->apellido)}}</td>
                        <td>{{ucwords($empleado->nombre)}}</td>
                        <td>{{$empleado->area_trabajo}}</td>
                        @if(isset($empleado->dieta['tipo_2']))
                        <td>{{$empleado->dieta['tipo_1'].','.$empleado->dieta['tipo_2']}}</td>
                        @else
                        <td>{{$empleado->dieta['tipo_1']}}</td>
                        @endif
                     </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
@endsection