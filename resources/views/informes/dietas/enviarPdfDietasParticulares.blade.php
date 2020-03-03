<!DOCTYPE html>
<html lang="es">
    <head>
        <title>
            Informe de Dietas General
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
                        <img src="{{public_path('img/render.png')}}"style="height:80px;">
                        
                    </span>
                    <span class="float-center">
                       
                        <strong>Área Medica-Ángel Estrada y Cia.</strong>
                    </span>
                    <span class="float-right">
                        <img src="{{public_path('img/AE.png')}}"style="height:80px;">   
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
                                @foreach($Destinatario as $destino)
                                {{$destino->cargo}} - {{$destino->apellido}} {{$destino->nombre}}
                            </span>
                            <br>
                                <span>
                                    {{$destino->area_trabajo}}
                                    @endforeach
                                </span>
                                <br>
                                    <span>
                                        S____________/___________D
                                    </span>
                                    <br>
                                        <br>
                                            <p class="text-justify" id="leyenda">
                                                Por la presente se eleva a esa unidad de trabajo los datos personales del empleado, respectivos a sus dietas:  
                                            </p>
                                            <br>
                                            @foreach($Dietas as $dieta)
                                            <p class="text-left" id="leyenda2">
                                                <strong>NOMBRE: </strong>{{$dieta->dieta['nombre']}}
                                            </p>
                                            <p class="text-left" id="leyenda2">
                                                 <strong>APELLIDO: </strong>{{$dieta->dieta['apellido']}}
                                            </p>
                                            <p class="text-left" id="leyenda2">
                                                  <strong>LEGAJO: </strong>{{$dieta->legajo_id}}
                                            </p>
                                            <p class="text-left" id="leyenda2">
                                                  <strong>TIPO DE DIETA:</strong>{{$dieta->tipo_1}},{{$dieta->tipo_2}}
                                            </p>
                                            <p class="text-left" id="leyenda2">
                                                  <strong>COMIDAS PERMITIDAS:</strong>{{$dieta->comidas_permitidas}}
                                            </p>
                                            <p class="text-left" id="leyenda2">
                                                  <strong>COMIDAS NO PERMITIDAS:</strong>{{$dieta->comidas_no_permitidas}}
                                            </p>
                                            @endforeach
                                            <br>
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
            </div>
        </hr>
    </body>
</html>