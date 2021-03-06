@extends('layouts.app2')




@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js" type="text/javascript">
</script>
<script src="https://www.gstatic.com/charts/loader.js" type="text/javascript">
</script>
<script type="text/javascript">
      
      google.charts.load('current', {'packages':['corechart','bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
           ['Riesgo', 'Cantidad',{ role: 'style' }],
           ["Bajo Riesgo", {{$contadorBajo}},'#0DF946'],
           ["Medio Riesgo", {{$contadorMedio}},'#F3FE11'],
           ["Alto Riesgo", {{$contadorAlto}},'#F80606'],
        
        ]);

        var options = {
         title: 'Riesgo del Personal',

          legend: { position: "none" }
        };
        var chart_area = document.getElementById('piechart');
        var chart = new google.visualization.ColumnChart(chart_area);

        google.visualization.events.addListener(chart, 'ready', function(){
         chart_area.innerHTML = '<div src="' + chart.getImageURI() + '" class="img-responsive" id="prueba">';
        });
        
        chart.draw(data, options);
      };
        
       $(window).resize(function() {
       drawStuff();
      });
</script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart','bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
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

        var chart = new google.visualization.ColumnChart(document.getElementById('piechart2'));

        chart.draw(data, options);
         
      }
      $(window).resize(function() {
        drawChart();
      });
       
</script>

<div class="container">
    <div class="card">
        <div class="card-body">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">
                            Enfermedades de Alto Riesgo 

                        </h1>
                        @if($riesgo->isEmpty())
                        <span class="alert alert-danger">
                            No hay riesgos para mostrar en el grafico
                        </span>
                        @else
                        <div class="card">
                            <div class="card-header row m-2">
                                Grafico de Enfermedades de alto riesgo por Area
                                <div class="m-auto col-xs-2">
                                    @include('includes.guardado')
                                    @include('includes.error')
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row" id="row">
                                   
                                    <div class="chart-area text-center col-lg-6" id="piechart2"></div>    
                                    <div class="col-lg-6">
                                        <div class="col-lg-12 m-auto py-1">
                                            <div class="row">
                                                <div class="col-md-6 mt-3 pr-5">
                                                    <a class="btn btn-info" href="{{ route('informe-enfermedad.enfermedadAreas') }}">
                                                        Ver Areas
                                                    </a>
                                                </div>
                                                <form action="{{ route('informe-enfermedad.verPdf') }}" id="form_ver_pdf" method="post" target="_blank">
                                                    @csrf
                                                    <div class="form-group">
                                                        <input id="ver_html" name="ver_html" type="hidden"/>
                                                    </div>
                                                    <select class="mt-2 form-control form-control-user" name="prueba" required="" id="destinatario1">
                                                            <option disabled="" selected="">
                                                                Seleccione a quien enviar el informe
                                                            </option>
                                                            @foreach($directivos as $directivo)
                                                            <option value="{{$directivo}}">
                                                                {{$directivo->nombre }} {{ $directivo->apellido}} - {{ $directivo->area_trabajo }}
                                                            </option>
                                                        @endforeach
                                                        </select>
                                                    <div class="form-group">
                                                        <button class="btn btn-secondary" id="ver_pdf" name="ver_pdf" type="submit">
                                                            Vista Preliminar
                                                        </button>
                                                    </div>
                                                    <!-- BUTTON -->
                                                </form>
                                            </div>
                                            <form action="{{ route('informe-enfermedad.enviarPdf') }}" id="make_pdf" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <input id="hidden_html" name="hidden_html" type="hidden"/>
                                                    <div class="content-center">
                                                        <select class="mt-2 form-control form-control-user" name="prueba" required="" id="destinatario2">
                                                            <option disabled="" selected="">
                                                                Seleccione a quien enviar el informe
                                                            </option>
                                                           @foreach($directivos as $directivo)
                                                            <option value="{{$directivo}}">
                                                                {{$directivo->nombre }} {{ $directivo->apellido}} - {{ $directivo->area_trabajo }}
                                                            </option>
                                                        @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btn-primary" id="create_pdf" name="create_pdf" type="submit">
                                                        Enviar PDF
                                                    </button>
                                                </div>
                                                <!-- BUTTON -->
                                            </form>
                                        </div>
                                        <!-- BUTTON Y SELECT -->
                                    </div>
                                    <!-- BUTTON Y SELECT GENERAL -->
                                </div>
                                <!-- ROW DEL BODY -->
                            </div>
                             <div class="chart-area text-center col-lg-6" id="piechart"></div>
                            <!-- CAR-BODY-->
                        </div>
                        <!-- CARD -->
                    </div>
                    <!-- TEXT-CENTER -->
                </div>
            </div>
        </div>
    </div>
    @endif

<script>
    $('#destinatario1').hide();
      $('#create_pdf').hide();
      $('#ver_pdf').hide();
       
        $(document).ready(function(){
        $('#create_pdf').click(function(){
        $('#hidden_html').val($('#prueba').attr('src'));
        $('#make_pdf').submit();


        });
        
        $('#ver_pdf').click(function(){
        
        $('#ver_html').val($('#prueba').attr('src'));
        
        $('#form_ver_pdf').submit();
       
        });

    });
        $('#destinatario2').on('change', function() {
        $('#create_pdf').show();
        $('#ver_pdf').show();
        var destinatario=$('#destinatario2').val();
        $('#destinatario1').val(destinatario);
      });
    </script>

@endsection