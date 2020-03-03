@extends('layouts.app2')

@section('content')
<style type="text/css">
  
  #gota::before{
    color:#e74a3b;
  }
  #jeringa::before{
    color:#1cc88a;
  }

  #usuarioIcon::before{
    color:#36b9cc;
  }
 
  #pregunta::before{
    color:#f6c23e;
  }

</style>
<div class="container">
  <h6 >Bienvenido {{ Auth::user()->nombre }}, su Rol es: <strong>{{ Auth::user()->roles->nombre}}</strong></h6>
    <div class="row">
       {{-- Cartel de Vacunas colocadas en el area --}}
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Vacunas Colocadas</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$numeroDeVacunas}}</div>
                    </div>
                    <div class="col-auto">
                      
                      <i id="jeringa"class="fas fa-syringe fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            {{-- Cartel de Consultas en el area --}}
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Consultas Realizadas</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$numeroDeConsultas}}</div>
                    </div>
                    <div class="col-auto">
                      <i id="pregunta" class="fas fa-question fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            {{-- Cartel de Donaciones en el area --}}
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Donaciones Realizadas</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$numeroDeDonaciones}}</div>
                    </div>
                    <div class="col-auto">
                      
                        <i id="gota" class="fas fa-tint fa-2x text-gray-300"></i>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            {{-- Cartel de empleados cargados en el area --}}
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Empleados Cargados</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$numeroDeEmpleados}}</div>
                    </div>
                    <div class="col-auto">
                        <i id="usuarioIcon" class="fas fa-user-tie fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
    </div>
<div class="row">

          
           
         {{--  Grafico 1 --}}
            <div class="col-xl-4 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Grupos Sanguineo</h6>
                </div>
                  <div class="chart-pie" id="grafico1"></div>
              </div>
            </div>

           {{--  Grafico 2 --}}
             <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Tipos de  Dietas</h6>
                </div>
                  <div class="chart-pie" id="grafico2"></div>
              </div>
            </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript">
</script>
<script src="https://www.gstatic.com/charts/loader.js" type="text/javascript">
</script>
<script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Grupo Sanguineo', 'Cantidad'],
          ['O-', {{$oNegativo}}],
          ['O+', {{$oPositivo}}],
          ['AB-', {{$ABNegativo}}],
          ['AB+', {{$ABPositivo}}],
          ['A-', {{$ANegativo}}],
          ['A+', {{$APositivo}}],
          ['B-', {{$BNegativo}}],
          ['B+', {{$BPositivo}}]
          
        ]);

        var options = {
        
          
        };

        var chart = new google.visualization.PieChart(document.getElementById('grafico1'));

        chart.draw(data, options);
         
      }
      $(window).resize(function() {
        drawChart();
      });

      google.charts.load('current', {'packages':['corechart','bar']});
      google.charts.setOnLoadCallback(drawChart1);

      function drawChart1() {
        var data = google.visualization.arrayToDataTable([
           ['Tipo de Dieta', 'Cantidad'],
           ["General", {{$contadorGeneral}}],
           ["Celiacos", {{$contadorCelia}}],
           ["Hipo Sodica", {{$contadorHipo}}],
           ["Diabeticos", {{$contadorDiabe}}],
           ["Vegetarianos", {{$contadorVegetariano}}]

          
        ]);

        var options = {
          
          
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('grafico2'));

        chart.draw(data, options);
         
      }
      $(window).resize(function() {
        drawChart1();
      });
     
</script>


@endsection
