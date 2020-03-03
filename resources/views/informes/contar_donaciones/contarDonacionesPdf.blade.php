<!DOCTYPE html>
<html lang="es">
    <head>
        <title>
            Informe de Cantidad de Donaciones
        </title>
        <meta charset="utf-8">
        </meta>
        <link crossorigin="anonymous" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" rel="stylesheet">
        </link>
        <style type="text/css">
            @page { 
            margin: 180px 25px; 
        }

        #header { 
            position: fixed; 
            left: 0px; 
            top: -180px;
            right: 0px; 
            height:100px; 
            background-color: transparent; 
            text-align: center;
            padding: 0px 20px;
            padding-top: 40px;
        }
        #footer { 
            position: fixed; 
            left: 0px; 
            bottom: -180px; 
            right: 0px; 
            height: 50px; 
            background-color: transparent; 
        }

        #footer .page:after { content: counter(page, decimal); }

        #leyenda{
            text-indent:20% !important;
        }

        #pie{
            text-align: right;
            padding-right: 30px;
        }
        </style>
    </head>
    <body>
        {{-- Cabecera --}}
        <div id="header">
            <div class="row">
                <div class="col">
                    <span class="float-left">
                        <img src="{{public_path('img/render.png')}}" style="height:80px;">
                        </img>
                    </span>
                    <span class="float-center">
                        <strong>
                            Área Medica-Ángel Estrada y Cia.
                        </strong>
                    </span>
                    <span class="float-right">
                        <img src="{{public_path('img/AE.png')}}" style="height:80px;">
                        </img>
                    </span>
                    <div class="clearfix">
                    </div>
                </div>
            </div>
        </div>
        {{--
        <hr>
            Linea que separa cabecera --}}
            <div id="footer">
                <p class="page" id="pie">
                    Pagina
                </p>
            </div>
            <div id="content">
                <div class="row">
                    <div class="col">
                        <span class="float-right">
                            La Rioja, {{date('d/m/Y')}}
                        </span>
                        <div class="clearfix">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <span>
                            AL SEÑOR/A
                        </span>
                        <br>
                            <span>
                                {{ json_decode($nombreEnvio)->cargo }} - {{ json_decode($nombreEnvio)->nombre }} {{ json_decode($nombreEnvio)->apellido }}
                            </span>
                            <br>
                                <span>
                                    {{json_decode($nombreEnvio)->area_trabajo}}
                                </span>
                                <br>
                                    <span>
                                        S____________/___________D
                                    </span>
                                    <br>
                                        <br>
                                            <p class="text-justify" id="leyenda">
                                                 Por la presente se eleva a esa unidad de trabajo la nomina de personal detallando la cantidad de donaciones realizadas.
                                            </p>
                                            <p class="text-justify" id="leyenda">
                                                Motiva dicha notificación, a que queda en su total autoridad llevar a cabo la medida correspondiente.
                                            </p>
                                            <p class="text-justify" id="leyenda">
                                                Sin otro particular, saludo Atentamente.
                                            </p>
                                        </br>
                                    </br>
                                </br>
                            </br>
                        </br>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <table cellspacing="0" class="table" width="100%">
                            <thead>
                                <tr>
                                    <th>
                                        Legajo
                                    </th>
                                    <th>
                                        Apellido y Nombre
                                    </th>
                                    <th>
                                        Primera Fecha
                                    </th>
                                    <th>
                                        Segunda Fecha
                                    </th>
                                    <th>
                                        Tercera Fecha
                                    </th>
                                    <th>
                                        Cantidad
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($donaciones as $donacion)
                                <tr>
                                    <td>
                                        {{strtoupper($donacion->legajo_id)}}
                                    </td>
                                    <td>
                                        {{ucwords($donacion->empleado->apellido)}}  {{ucwords($donacion->empleado->nombre)}}
                                    </td>
                                    @if(!$donacion->fecha_1)
                                    <td>
                                    </td>
                                    @else
                                    <td>
                                        {{date('d-m-Y', strtotime($donacion->fecha_1))}}
                                    </td>
                                    @endif
                                    @if(!$donacion->fecha_2)
                                    <td>
                                    </td>
                                    @else
                                    <td>
                                        {{date('d-m-Y', strtotime($donacion->fecha_2))}}
                                    </td>
                                    @endif
                                    @if(!$donacion->fecha_3)
                                    <td>
                                    </td>
                                    @else
                                    <td>
                                        {{date('d-m-Y', strtotime($donacion->fecha_3))}}
                                    </td>
                                    @endif
                                    <td>
                                        {{$donacion->total}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="text-center">
                        <img class="mt-5 pt-2 border" height="250px" src="{{$urlGrafico}}" width="600px">
                        </img>
                        <p>Grafico que refleja la cantidad de donaciones por mes del personal</p>
                    </div>
                </div>
            </div>
        </hr>
    </body>
</html>