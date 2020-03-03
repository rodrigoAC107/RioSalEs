@extends('layouts.app2')

@section('content')

<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body">
        <!-- Nested Row within Card Body -->
        <div class="row">

          <div class="col-lg-12">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Vacunas</h1>
                <div class="d-flex justify-content-center text-center ">
              	@include('includes.error')
              	</div>
              </div>
              
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Legajo</th>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Estado</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                     @foreach($controles as $control)
                        
                        <td>{{$control->controlVacuna->legajo}}</td>
                        <td>{{$control->controlVacuna->nombre}}</td>
                        <td >{{$control->controlVacuna->apellido}}</td>
                        <td class="alert {{$control->color}}">{{$control->estado}}-{{$control->porcentaje}}%</td>
                        <td class="text-center">
                          <a href="{{ route('vacunas.show', $control->controlVacuna->legajo) }}" class="btn btn-info m-1" title="Agregar Vacuna"><i class="fas fa-syringe"></i></a>
                          <a href="{{ route('vacunas.mostrar', $control->controlVacuna->legajo) }}" class="btn btn-success m-1" title="Ver Carnet"><i class="fas fa-clipboard-list"></i></a>
                        </td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
          	  

             	
              		
              
          </div>
        </div>
       </div>
    </div>
 </div>







@endsection