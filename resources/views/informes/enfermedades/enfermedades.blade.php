@extends('layouts.app2')



@section('content')

<!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Enfermedades por Area</h6>
            </div>
            <div class="d-flex justify-content-center text-center text-uppercase pb-3 py-3">
              @include('includes.guardado')
              </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Area</th>
                      <th>Enfermedad</th>
                      <th>Riesgo</th>
                      <th>Accion</th>
                    </tr>
                  </thead>
                  <tbody>
                  	@foreach($enfermedades as $enfermedad)
                    <tr>
                      <td>{{$enfermedad->area}}</td>
                      <td>{{$enfermedad->enfermedad}}</td>
                      <td>{{$enfermedad->riesgo}}%</td>
                      <td class="text-center">
                      	<a href="{{ route('informe-enfermedad.edit', $enfermedad->id) }}" class="btn btn-info m-1"><i class="far fa-edit"></i></a>
                      </td>
                    </tr>  
                    
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>







@endsection