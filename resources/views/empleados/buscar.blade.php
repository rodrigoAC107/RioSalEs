@extends('layouts.app2')

@section('content')
<!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Datos del Paciente</h6>
            </div>
            <div class="d-flex justify-content-center text-center text-uppercase pb-3 py-3">
              @include('includes.guardado')
              </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Legajo</th>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Área</th>
                      <th>Telefono</th>
                      <th>Anteojo</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                     @foreach($empleados as $empleado)
                     <tr>
                        <td>{{$empleado->legajo}}</td>
                        <td>{{$empleado->nombre}}</td>
                        <td>{{$empleado->apellido}}</td>
                        <td>{{$empleado->area_trabajo}}</td>
                        <td>{{$empleado->telefono}}</td>
                        <td>{{$empleado->anteojos}}</td>
                        <td class="text-center">
                          <a href="{{ route('empleado.datos', $empleado->legajo) }}" class="btn btn-primary m-1"><i class="far fa-eye"></i></a> 
                          @if(Auth::user()->rol_id == 1 || Auth::user()->rol_id == 2)
                          <a href="{{ route('empleado.edit', $empleado->legajo) }}" class="btn btn-info m-1"><i class="far fa-edit"></i></a>
                          @endif
                          @if(Auth::user()->rol_id == 1)
                          <a href="{{ route('empleado.delete', $empleado->legajo) }}"
                             class="btn btn-danger m-1"
                             onclick=" return confirm('Quieres eliminar el registro?')">
                             <i class="fas fa-trash"></i>
                          </a>
                          @endif
                        </td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
@endsection