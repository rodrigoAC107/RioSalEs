@extends('consultas.historiaClinica')



@section('resultado')
		
		  @foreach($datosNombre as $dato)	
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Historia Clinica de {{$dato->consulta['apellido']}}, {{$dato->consulta['nombre']}} </h6>
            </div>
            @endforeach
            <div class="d-flex justify-content-center text-center text-uppercase pb-3 py-3">
              @include('includes.guardado')
              </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Legajo</th>
                      <th>Consulta</th>
                      <th>Motivo</th>
                      <th>Temperatura</th>
                      <th>Sistolica</th>
                      <th>Diastolica</th>
                      <th>Frecuencia Respiratoria</th>
                      <th>Frecuencia Arterial</th>
                      <th>Fecha de Consulta</th>

                    </tr>
                  </thead>
                  <tbody>
                     @foreach($datos as $dato)
                     <tr>
                        <td>{{$dato->legajo_id}}</td>
                        <td>{{$dato->tipo_consulta}}</td>
                        <td>{{$dato->motivo}}</td>
                        <td>{{$dato->signos['temperatura']}}</td>
                        <td>{{$dato->signos['sistolica']}}</td>
                        <td>{{$dato->signos['diastolica']}}</td>
                        <td>{{$dato->signos['frecuencia_respiratoria']}}</td>
                        <td>{{$dato->signos['frecuencia_arterial']}}</td>
                        <td>{{$dato->fecha_consulta}}</td>
                     </tr>
                     @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          




@endsection