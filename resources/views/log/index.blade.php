@extends('layouts.app2')

@section('content')
<!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Registro de Actividades</h6>
            </div>
            <div class="d-flex justify-content-center text-center text-uppercase pb-3 py-3">
              @include('includes.guardado')
              </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-sm table-hover table-bordered" id="example" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Id</th>
                      <th>Modelo</th>
                      <th>Descripcion</th>
                      <th>Fecha</th>
                      <th>Responsable</th>
                      <th>Detalles</th>
                    </tr>
                  </thead>
                  <tbody>
                     @foreach($actividades as $actividad)
                     <tr>
                        <td>{{$actividad->id}}</td>
                        <td>{{$actividad->log}}</td>
                        <td>{{$actividad->descripcion}}</td>
                        <td>{{$actividad->fecha}}</td>
                        <td>{{$actividad->responsable}}</td>
                        <td>{{$actividad->detalles}}</td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
@endsection