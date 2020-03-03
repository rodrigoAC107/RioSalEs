@extends('layouts.app2')



@section('content')
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body">
      <div><a href="{{ URL::previous() }}" class="btn btn-info m-1"><i class="fas fa-chevron-left"></i></a></div>


        <!-- Nested Row within Card Body -->
        <div class="row">

          <div class="col-lg-12">
              <div class="text-center">
           		
                <h1 class="h4 text-gray-900 mb-4">Carnet Vacunas de <strong>{{$datoApellido}},{{$datoNombre}}</strong></h1>
                
                <div class="d-flex justify-content-center text-center ">
              	@include('includes.error')
              	</div>

              </div>
              
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Fecha</th>
                      <th>Dosis Nro.1</th>
                      <th>Dosis Nro.2</th>
                      <th>Dosis Nro.3</th>
                      <th>Estado</th>
                    </tr>
                  </thead>
                  <tbody>

                     @foreach($vacunas as $vacuna)
                        
                        <td>{{$vacuna->nombre}}</td>
                        <td>{{$vacuna->fecha}}</td>
                        <td >{{$vacuna->dosis_1}}</td>
                        <td >{{$vacuna->dosis_2}}</td>
                        <td >{{$vacuna->dosis_3}}</td>
                        @if($vacuna->estado=="Completo")
                        <td class="alert alert-success">{{$vacuna->estado}}</td>
                        @elseif($vacuna->estado=="Incompleto")
                        <td class="alert alert-danger">{{$vacuna->estado}}</td>
                        @elseif($vacuna->estado=" ")
                        <td class="alert alert-danger">Incompleto</td>
                        @endif
                       
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