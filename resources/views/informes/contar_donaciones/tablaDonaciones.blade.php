@extends('layouts.app2')

@section('content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            Datos de cada una de las donaciones de los Pacientes
        </h6>
    </div>
    <div class="d-flex justify-content-center text-center text-uppercase pb-3 py-3">
        @include('includes.guardado')
    </div>
    <div class="card-body">
  <div><a href="{{ URL::previous() }}" class="btn btn-info m-1"><i class="fas fa-chevron-left"></i></a></div>

        <div class="table-responsive">
            <table cellspacing="0" class="table table-bordered" id="dataTable" width="100%">
                <thead>
                    <tr>
                        <th>
                            Legajo
                        </th>
                        <th>
                            Apellido y Nombre
                        </th>
                        <th>
                            Primera Fecha
                        </th>
                        <th>
                            Segunda Fecha
                        </th>
                        <th>
                            Tercera Fecha
                        </th>
                        <th>
                            Cantidad
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($donaciones as $donacion)
                    <tr>
                        <td>
                            {{strtoupper($donacion->legajo_id)}}
                        </td>
                        <td>
                            {{ucwords($donacion->empleado->apellido)}}  {{ucwords($donacion->empleado->nombre)}}
                        </td>
                        @if(!$donacion->fecha_1)
                        <td>
                        </td>
                        @else
                        <td>
                            {{date('d-m-Y', strtotime($donacion->fecha_1))}}
                        </td>
                        @endif
                        @if(!$donacion->fecha_2)
                        <td>
                        </td>
                        @else
                        <td>
                            {{date('d-m-Y', strtotime($donacion->fecha_2))}}
                        </td>
                        @endif
                        @if(!$donacion->fecha_3)
                        <td>
                        </td>
                        @else
                        <td>
                            {{date('d-m-Y', strtotime($donacion->fecha_3))}}
                        </td>
                        @endif
                        <td>
                            {{$donacion->total}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
