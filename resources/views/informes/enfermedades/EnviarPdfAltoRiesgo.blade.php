<!DOCTYPE html>
<html lang="es">
    <head>
        <title>
            Informe de Riesgos
        </title>
        <meta charset="utf-8">
            <link crossorigin="anonymous" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" rel="stylesheet">
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
            </link>
        </meta>
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
                                {{$Destinatario->cargo}} - {{$Destinatario->apellido}} {{$Destinatario->nombre}}
                            </span>
                            <br>
                                <span>
                                    {{$Destinatario->area_trabajo}}
                                </span>
                                <br>
                                    <span>
                                        S____________/___________D
                                    </span>
                                    <br>
                                        <br>
                                            <p class="text-justify" id="leyenda">
                                                Por la presente se eleva a esa unidad de trabajo la nomina de personal detallando de manera individual el riesgo de trabajo dentro de su area de desempeño laboral.
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
                        <table cellspacing="0" border="1" class="mb-0" width="100%">
                            <thead>
                                <tr class="text-center">
                                    <th>
                                        Legajo
                                    </th>
                                    <th>
                                        Apellido
                                    </th>
                                    <th>
                                        Nombre
                                    </th>
                                    <th>
                                        Área
                                    </th>
                                    <th>
                                        Enfermedad
                                    </th>
                                    <th>
                                        Riesgo
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($emplados_enfermedad as $empleado)
                                <tr class="text-center">
                                    <td>
                                        {{($empleado->legajo_id)}}
                                    </td>
                                    <td>
                                        {{$empleado->Rriesgo['nombre']}}
                                    </td>
                                    <td>
                                        {{$empleado->Rriesgo['apellido']}}
                                    </td>
                                    <td>
                                        {{$empleado->area_trabajo}}
                                    </td>
                                    <td>
                                        {{$empleado->enfermedad}}
                                    </td>
                                    @foreach($riesgos as $riesgo)
                                    @if($riesgo->area==$empleado->area_trabajo && $riesgo->enfermedad==$empleado->enfermedad)
                                    <td>
                                        @if($riesgo->riesgo>0 && $riesgo->riesgo<=24)
                                            Bajo Riesgo
                                        
                                        @elseif($riesgo->riesgo>24 && $riesgo->riesgo<=50)
                                            Medio Riesgo
                                        
                                        @else
                                            Alto Riesgo
                                        
                                        @endif
                                    </td>
                                    @endif
                                    @endforeach
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
                        <p>Grafico que refleja la cantidad de Empleados por el tipo de Riesgo</p>
                       
                    </div>
                </div>
            </div>
        </hr>
    </body>
</html>