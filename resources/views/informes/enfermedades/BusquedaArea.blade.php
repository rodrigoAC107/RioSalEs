 @extends('informes.enfermedades.VerEnfermedadesPorArea')





 @section('resultado')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript">
</script>
<script src="https://www.gstatic.com/charts/loader.js" type="text/javascript">
</script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Enfermedad', 'Cantidad'],
          @foreach($contar as $cont=>$valor)

          ['{{$cont}}',{{$valor}}],

          @endforeach
          
       
          
        ]);

        var options = {
          title: 'Grafica de Enfermedades del area',
          
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
           ['Riesgo', 'Cantidad',{ role: 'style' }],

           ["Bajo Riesgo", {{$contadorBajo}},'#0DF946'],
           ["Medio Riesgo", {{$contadorMedio}},'#F3FE11'],
           ["Alto Riesgo", {{$contadorAlto}},'#F80606'],
          
        ]);
         

        var options = {
          title: 'Riesgo del Personal',

          legend: { position: "none" }
          
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('grafico2'));

        chart.draw(data, options);
         
      }
      $(window).resize(function() {
        drawChart1();
      });
       
</script>
<script type="text/javascript">
      
       
</script>
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body">
        
        <!-- Nested Row within Card Body -->
       <div class="row">
          <div class="col-lg-12">
              <div class="text-center">
              	
                <h1 class="h4 text-gray-900 mb-4">Informe del Area {{$titulo}}</h1>
                 Cantidad de Pacientes con enfermedad en el area: {{$contadorDeEmpleados}}
              </div>
              
           
            

		      </div>
		      <div class="chart-area text-center col-lg-6" id="grafico1"></div>  
              <div class="chart-area text-center col-lg-6" id="grafico2"></div> 

        </div>
        <hr>
        
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Nomina de Pacientes</h6>
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
                      <th>Apellido</th>
                      <th>Nombre</th>
                      <th>Enfermedad</th>
                      <th>Riesgo</th>
                    </tr>
                  </thead>
                  <tbody>
                     @foreach($areaActual as $empleado)
                     <tr>
                        <td>{{$empleado->legajo_id}}</td>
                        <td>{{$empleado->Rriesgo['apellido']}}</td>
                        <td>{{$empleado->Rriesgo['nombre']}}</td>
                        <td>{{ucwords($empleado->enfermedad)}}</td>
                        @foreach($riesgoArea as $riesgo)
                                    @if($riesgo->area==$empleado->area_trabajo && $riesgo->enfermedad==$empleado->enfermedad)
                                    
                                        @if($riesgo->riesgo>0 && $riesgo->riesgo<=24)
                                        <td class="alert alert-success">
                                            Bajo Riesgo
                                        </td>
                                        @elseif($riesgo->riesgo>24 && $riesgo->riesgo<=50)
                                        <td class="alert alert-warning">
                                            Medio Riesgo
                                        </td>
                                        @else
                                        <td class="alert alert-danger">
                                            Alto Riesgo
                                        </td>
                                        @endif
                                    
                                    @endif
                        @endforeach
                     </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          

      </div>
    </div>
</div>
  






















 @endsection