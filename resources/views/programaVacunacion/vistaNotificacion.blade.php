@extends('layouts.app2')



@section('content')
<div class="card">
<div class="card-head">
<div class="container">
<div class="container-fluid">

<div class="card-body">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
              <div class="text-center">
                <center>
                @include('includes.guardado')
                </center>
                <h1 class="h4 text-gray-900 mb-4">Programa de Vacunacion</h1>
               </div>
            
               
          </div> 
        </div>
        <div class="row">
        @foreach($programa as $prog)	
         <strong><u>Nombre del Programa:</u> </strong>  <label> {{$prog->nombre}}</label>
        </div>
        <div class="row">
         <strong><u>Fecha:</u> </strong>  <label id="fecha" value="{{$prog->fecha}}">{{date('d-m-yy',strtotime($prog->fecha))}}</label>
     	</div>
         <div class="row">
         <strong><u>Area:</u> </strong> <label> {{$prog->area}}</label>
         </div>
         <div class="row">
         <strong><u>Observacion:</u> </strong>  <label> {{$prog->mensaje}}</label>
         </div>
         <div class="row">
            <div class="col-lg-12">
              <div class="text-center">
                  
                  <a href="{{ URL::previous() }}" class="btn btn-info m-1">Volver</a>
                  @if($fechaPrograma==$fechaDeHoy)
                  <a  id="comenzar" href="{{route('programaVacunacion.edit',$prog->id)}}" class="btn btn-danger m-1">Comenzar</a>
                  @endif
                  
              </div>
            </div>
          </div>
           
         @endforeach
          
        
</div>
</div>
</div>
</div>
</div>



@endsection