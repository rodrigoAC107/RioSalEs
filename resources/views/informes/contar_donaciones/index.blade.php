@extends('layouts.app2')


@section('content')
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
          ['Enero', {{$enero}}],
          ['Febrero', {{$febrero}}],
          ['Marzo', {{$marzo}}],
          ['Abril', {{$abril}}],
          ['Mayo', {{$mayo}}],
          ['Junio', {{$junio}}],
          ['Julio', {{$julio}}],
          ['Agosto', {{$agosto}}],
          ['Septiembre', {{$septiembre}}],
          ['Octubre', {{$octubre}}],
          ['Noviembre', {{$noviembre}}],
          ['Diciembre', {{$diciembre}}],

        ]);

        var options = {
          title: 'Grafica de cantidad de donaciones por mes ',
          pieHole: 0.4,
          pieSliceText: 'value'
        };

        var chart_area = document.getElementById('piechart');
        var chart = new google.visualization.PieChart(chart_area);

        google.visualization.events.addListener(chart, 'ready', function(){
         chart_area.innerHTML = '<div src="' + chart.getImageURI() + '" class="img-responsive" id="prueba">';
        });

        chart.draw(data, options);
      }
      $(window).resize(function() {
       drawChart();
      });
</script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Grupo Sanguineo', 'Cantidad'],
          ['Enero', {{$enero}}],
          ['Febrero', {{$febrero}}],
          ['Marzo', {{$marzo}}],
          ['Abril', {{$abril}}],
          ['Mayo', {{$mayo}}],
          ['Junio', {{$junio}}],
          ['Julio', {{$julio}}],
          ['Agosto', {{$agosto}}],
          ['Septiembre', {{$septiembre}}],
          ['Octubre', {{$octubre}}],
          ['Noviembre', {{$noviembre}}],
          ['Diciembre', {{$diciembre}}],
          
        ]);

        var options = {
          title: 'Grafica de cantidad de donaciones por mes',
          pieHole: 0.4,
          pieSliceText: 'value'
          
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));

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
                            Cantidad de donaciones anuales
                        </h1>
                        @if($donaciones->isEmpty())
                        <h1 class="btn btn-danger">
                            No hay empleados para mostrar grafica
                        </h1>
                        @else
                        <div class="card">
                            <div class="card-header row m-2">
                                Grafico de cantidad de donaciones
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
                                                    <a class="btn btn-info" href="{{ route('contar-donaciones.create') }}">
                                                        Ver Pacientes
                                                    </a>
                                                </div>
                                                <form action="{{ route('informe.contar-donaciones.verPdf') }}" id="form_ver_pdf" method="post" target="_blank">
                                                    @csrf
                                                    <div class="form-group">
                                                        <input id="ver_html" name="ver_html" type="hidden"/>
                                                    </div>
                                                    <select class="mt-2 form-control form-control-user" name="prueba" required="" id="destinatario1">
                                                            <option disabled="" selected="">
                                                                Seleccione a quien enviar el informe
                                                            </option>
                                                            @foreach($empleadosDirectivos as $Empleado)
                                                            @if($Empleado->area_trabajo == 'Gerencia' || $Empleado->area_trabajo == 'RR HH')
                                                            <option value="{{$Empleado}}">
                                                                {{$Empleado->nombre }} {{ $Empleado->apellido}} - {{ $Empleado->area_trabajo }}
                                                            </option>
                                                            @endif
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
                                            <form action="{{ route('informe.contar-donaciones.pdfDonacion') }}" id="make_pdf" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <input id="hidden_html" name="hidden_html" type="hidden"/>
                                                    <div class="content-center">
                                                        <select class="mt-2 form-control form-control-user" name="nombreArea" required="" id="destinatario2">
                                                            <option disabled="" selected="">
                                                                Seleccione a quien enviar el informe
                                                            </option>
                                                            @foreach($empleadosDirectivos as $Empleado)
                                                            @if($Empleado->area_trabajo == 'Gerencia' || $Empleado->area_trabajo == 'RR HH')
                                                            <option value="{{$Empleado}}">
                                                                {{$Empleado->nombre }} {{ $Empleado->apellido}} - {{ $Empleado->area_trabajo }}
                                                            </option>
                                                            @endif
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
</div>
