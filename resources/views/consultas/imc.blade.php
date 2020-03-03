@extends('layouts.app2')



@section('content')
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Indice de Masa Corporal ( I.M.C. )</h1>
              </div>
                 <div class="justify-content-center text-center text-uppercase py-1 d-block d-xl-none d-lg-none" style="font-size: x-large;font-size: 3vw">
                @include('includes.error')
                @include('includes.guardado')
                </div>
              <div class="justify-content-center text-center text-uppercase py-1 d-none d-xl-block d-lg-block" style="font-size: x-large;font-size: 2vw">
                @include('includes.error')
                @include('includes.guardado')
              </div>
              <form class="user" method="POST" id="form" action="{{route('imc.store')}}" autocomplete="on" {{-- onKeypress="if(event.keyCode == 13) event.returnValue = false;" --}}>
                @csrf
                <div class="form-group row">
                  <div class="col-sm-3 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user{{ $errors->has('legajo') ? ' is-invalid' : '' }}" name="legajo" value="{{ old('legajo') }}" required autofocus id="legajo" placeholder="Legajo">
                  </div>
                  <div class="col-sm-3 mb-3 mb-sm-0">
                      <button type="submit" class="btn btn-primary btn-user btn-block">
                                    {{ __('BUSCAR') }}
                                </button>
                 </div>
                </div>
              </form>

              
              
          </div>
        </div>
      </div>

    </div>
  </div>

@yield('resultado')
                

                

                
<script type="text/javascript" src="{{asset('js/script_empleados/jquery-3.4.1.min.js')}}"></script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Fecha', 'Calculo del IMC'],
          @foreach($legajo2 as $leg2)

          ["<?= date('d-m-Y h:i', strtotime($leg2->created_at)); ?>", {{$leg2->calculo_imc}}],
          @endforeach
          
        ]);

        var options = {
          title: 'IMC en el tiempo',
          curveType: 'function',
          legend: { position: 'bottom' }
          
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
      $(window).resize(function() {
        drawChart();
      });
    </script>

@endsection