@extends('layouts.app2')





@section('content')

<!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Informes de Dieta de los Pacientes</h6>
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
                      <th>Tipo de Dieta</th>
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

                        @if(isset($empleado->dieta['tipo_1']) && isset($empleado->dieta['tipo_2']))
                        <td>{{$empleado->dieta['tipo_1']}}, {{$empleado->dieta['tipo_2']}}</td>
                        @elseif(!isset($empleado->dieta['tipo_1']))
                        <td>Sin dieta Especificada</td>
                        @else
                        <td>{{$empleado->dieta['tipo_1']}}</td>
                        @endif
                        <td class="text-center">
                          @if(isset($empleado->dieta['tipo_1']))
                          <a href="{{ route('informe-dietas.show', $empleado->legajo) }}" class="btn btn-info m-1" title="Editar"><i class="far fa-edit"></i></a>
                          
                          <a href="{{ route('infome-dietas.pdfDietaEspecifica', $empleado->legajo) }}"  target="_blank" class="btn btn-primary m-1" title="Vista Preliminar"><i class="far fa-eye"></i></a> 
                          <a href="{{ route('informe-dietas.enviarPdfEspecificas', $empleado->legajo) }}" class="btn btn-success m-1" title="Enviar Informe"><i class="fas fa-envelope-square"></i></a>
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