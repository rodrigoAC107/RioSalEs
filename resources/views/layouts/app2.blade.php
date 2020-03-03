<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
            <meta content="IE=edge" http-equiv="X-UA-Compatible">
                <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
                    <meta content="{{ csrf_token() }}" name="csrf-token">
                        <link href="{{asset('img/render.png')}}" rel="icon" type="image/png"/>
                        <title>
                            {{ config('app.name', 'Laravel') }}
                        </title>
                        <!-- Custom fonts for this template-->
                        <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
                            <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js">
                                </script>
                                <!-- Custom styles for this template-->
                                <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
                                    <link href="{{ asset('css/datosEmpleados.css') }}" rel="stylesheet">
                                        <!-- Scripts -->
                                        <script src="{{ asset('js/webcamjs/webcam.js') }}">
                                        </script>
                                        <!-- Custom styles for this page -->
                                        <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
                                        </link>
                                    </link>
                                </link>
                            </link>
                        </link>
                    </meta>
                </meta>
            </meta>
        </meta>
    </head>
    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('home')}}">
                    <div class="sidebar-brand-icon">
                        <i class="fas fa-user-md">
                        </i>
                    </div>
                    <div class="sidebar-brand-text mx-3">
                        RioSalEs
                    </div>
                </a>
                <!-- Divider -->
                <hr class="sidebar-divider my-0">
                    <!-- Divider -->
                    {{--
                    <hr class="sidebar-divider">
                        --}}
                        <!-- Heading -->
                        <div class="sidebar-heading">
                            Menú
                        </div>
                        <!-- Nav Item - Pages Collapse Menu de PACIENTE -->
                        <li class="nav-item">
                            <a aria-controls="collapseTwo" aria-expanded="true" class="nav-link collapsed" data-target="#collapseTwo" data-toggle="collapse" href="#">
                                <i class="fas fa-user-injured">
                                </i>
                                <span>
                                    Pacientes
                                </span>
                            </a>
                            <div aria-labelledby="headingTwo" class="collapse" data-parent="#accordionSidebar" id="collapseTwo">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <h6 class="collapse-header">
                                        Componente de pacientes:
                                    </h6>
                                    <a class="collapse-item" href="{{ route('empleado.informacion') }}">
                                        Cargar Paciente
                                    </a>
                                    <a class="collapse-item" href="{{ route('empleado.buscar') }}">
                                        Buscar Paciente
                                    </a>
                                </div>
                            </div>
                        </li>
                        <!-- Nav Item - Pages Collapse Menu de CONSULTA -->
                        <li class="nav-item">
                            <a aria-controls="collapseUtilities" aria-expanded="true" class="nav-link collapsed" data-target="#collapseUtilities" data-toggle="collapse" href="#">
                                <i class="fas fa-question">
                                </i>
                                <span>
                                    Consultas
                                </span>
                            </a>
                            <div aria-labelledby="headingUtilities" class="collapse" data-parent="#accordionSidebar" id="collapseUtilities">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <h6 class="collapse-header">
                                        Componentes de consulta:
                                    </h6>
                                    <a class="collapse-item" href="{{ route('consultas.cargarConsultas') }}">
                                        Nueva Consulta
                                    </a>
                                    <a class="collapse-item" href="{{ route('imc.create') }}">
                                        IMC
                                    </a>
                                    <a class="collapse-item" href="{{route('consultas.historiaClinica')}}">
                                        Historia Clinica
                                    </a>
                                </div>
                            </div>
                        </li>
                        <!-- Nav Item - Pages Collapse Menu de VACUNAS -->
                        <li class="nav-item">
                            <a aria-controls="collapse1" aria-expanded="true" class="nav-link collapsed" data-target="#collapse1" data-toggle="collapse" href="#">
                                <i class="fas fa-syringe">
                                </i>
                                <span>
                                    Vacunación
                                </span>
                            </a>
                            <div aria-labelledby="headingTwo" class="collapse" data-parent="#accordionSidebar" id="collapse1">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <h5 class="collapse-header" style="padding: .2rem 1rem !important;">
                                        Componente de vacunación:
                                    </h5>
                                    <a class="collapse-item" href="{{ route('vacunas.index') }}">
                                        Vacunas
                                    </a>
                                    @if(Auth::user()->rol_id == 1 || Auth::user()->rol_id == 2)
                                    <a class="collapse-item" href="{{route('programaVacunacion.index')}}">
                                        Programa de Vacunacion
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </li>
                        <!-- Nav Item - Pages Collapse Menu de VACUNAS -->
                        <li class="nav-item">
                            <a aria-controls="collapse2" aria-expanded="true" class="nav-link collapsed" data-target="#collapse2" data-toggle="collapse" href="#">
                                <i class="far fa-hospital">
                                </i>
                                <span>
                                    Donaciones
                                </span>
                            </a>
                            <div aria-labelledby="headingTwo" class="collapse" data-parent="#accordionSidebar" id="collapse2">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <h5 class="collapse-header" style="padding: .2rem 1rem !important;">
                                        Componente de donaciones:
                                    </h5>
                                    <a class="collapse-item" href="{{route('donacion.index')}}">
                                        Cargar Donantes
                                    </a>
                                </div>
                            </div>
                        </li>
                        <!-- Nav Item - Pages Collapse Menu de INFORMES -->
                        @if(Auth::user()->rol_id == 1 || Auth::user()->rol_id == 2)
                        <li class="nav-item">
                            <a aria-controls="collapse3" aria-expanded="true" class="nav-link collapsed" data-target="#collapse3" data-toggle="collapse" href="#">
                                <i class="far fa-clipboard">
                                </i>
                                <span>
                                    Informes
                                </span>
                            </a>
                            <div aria-labelledby="headingTwo" class="collapse" data-parent="#accordionSidebar" id="collapse3">
                                <div class="bg-white py-2 collapse-inner rounded">
                                    <h6 class="collapse-header">
                                        Informes de Donacioness:
                                    </h6>
                                    <a class="collapse-item" href="{{route('informe-donacion.index')}}">
                                        Tipo de Sangre
                                    </a>
                                    <a class="collapse-item" href="{{ route('contar-donaciones.index')}}">
                                        Contar Donaciones
                                    </a>
                                    <h6 class="collapse-header">
                                        Informes de Dietas:
                                    </h6>
                                    <a class="collapse-item" href="{{route('informe-dietas.index')}}">
                                        General
                                    </a>
                                    
                                    <a class="collapse-item" href="{{route('informe-dietas.dietasEspecificas')}}">
                                        Especifico
                                    </a>
                                    <h6 class="collapse-header">
                                        Informes de Enfermedades:
                                    </h6>
                                    <a class="collapse-item" href="{{route('informe-enfermedad.index')}}">
                                        Enfermedades
                                    </a>
                                    <a class="collapse-item" href="{{route('informe-enfermedad.create')}}">
                                        Alto Riesgo
                                    </a>
                                </div>
                            </div>
                        </li>
                        @endif
                        <!-- Divider -->
                        <hr class="sidebar-divider">
                            <!-- Sidebar Toggler (Sidebar) -->
                            <div class="text-center d-none d-md-inline">
                                <button class="rounded-circle border-0" id="sidebarToggle">
                                </button>
                            </div>
                        </hr>
                    </hr>
                </hr>
            </ul>
            <!-- End of Sidebar -->
            <!-- Content Wrapper -->
            <div class="d-flex flex-column" id="content-wrapper">
                <!-- Main Content -->
                <div id="content">
                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                        <!-- Sidebar Toggle (Topbar) -->
                        <button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop">
                            <i class="fa fa-bars">
                            </i>
                        </button>
                       
                        <ul class="navbar-nav ml-auto">
                            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                            <li class="nav-item dropdown no-arrow d-sm-none">
                                <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="searchDropdown" role="button">
                                    <i class="fas fa-search fa-fw">
                                    </i>
                                </a>
                                <!-- Dropdown - Messages -->
                                <div aria-labelledby="searchDropdown" class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in">
                                    <form class="form-inline mr-auto w-100 navbar-search">
                                        <div class="input-group">
                                            <input aria-describedby="basic-addon2" aria-label="Search" class="form-control bg-light border-0 small" placeholder="Search for..." type="text">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="button">
                                                        <i class="fas fa-search fa-sm">
                                                        </i>
                                                    </button>
                                                </div>
                                            </input>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            {{--  notificaciones --}}
                            <li class="nav-item dropdown no-arrow mx-1">
                                <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="alertsDropdown" role="button">
                                    <i class="fas fa-bell fa-fw">
                                    </i>
                                    <!-- Counter - Alerts -->
                                    <span class="badge badge-danger badge-counter">
                                        {{$contadorNotificacion}}
                                    </span>
                                </a>
                                <!-- Dropdown - Alerts -->
                                <div aria-labelledby="alertsDropdown" class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in">
                                    <h6 class="dropdown-header">
                                        Notificaciones
                                    </h6>
                                    @foreach($notificaciones as $notificacion)
                                    <a class="dropdown-item d-flex align-items-center" href="{{route('programaVacunacion.show',$notificacion->id)}}">
                                        {{$notificacion->nombre}}, Fecha:{{$notificacion->fecha}}
                                    </a>
                                    @endforeach
                                </div>
                            </li>
                            <div class="topbar-divider d-none d-sm-block">
                            </div>
                            <!-- Nav Item - User Information -->
                            <li class="nav-item dropdown no-arrow">
                                <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="userDropdown" role="button">
                                    @if(Auth::user()->imagen)
                                    <img class="img-profile rounded-circle" src="{{asset('storage/perfilUsuario/'.Auth::user()->imagen)}}">
                                        @else
                                        <img class="img-profile rounded-circle" src="{{asset('img/render.png')}}">
                                            @endif
                                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                                {{ Auth::user()->apellido }} {{ Auth::user()->nombre  }}
                                            </span>
                                        </img>
                                    </img>
                                </a>
                                <!-- Dropdown - User Information -->
                                <div aria-labelledby="userDropdown" class="dropdown-menu dropdown-menu-right shadow animated--grow-in">
                                    @if(Auth::user()->rol_id == 1)
                                    <a class="dropdown-item" href="{{route('usuarios.index')}}">
                                        <i class="fas fa-user-edit fa-sm fa-fw mr-2 text-gray-400">
                                        </i>
                                        Editar Usuario
                                    </a>
                                    <a class="dropdown-item" href="{{ route('registrar.index') }}">
                                        <i class="fas fa-user-plus fa-sm fa-fw mr-2 text-gray-400">
                                        </i>
                                        Crear Usuario
                                    </a>
                                    <a class="dropdown-item" href="{{route('log.index')}}">
                                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400">
                                        </i>
                                        Registro de Actividades
                                    </a>
                                    @endif
                                    <div class="dropdown-divider">
                                    </div>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400">
                                        </i>
                                        {{ __('Cerrar Sesión') }}
                                    </a>
                                    <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <!-- End of Topbar -->
                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                       
                        <main class="py-4">
                            @yield('content')
                            @yield('javascript')
                        </main>
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->
                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>
                                <strong>Area Medica</strong>-Angél Estrada y Cia.
                            </span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up">
            </i>
        </a>
        <!-- Logout Modal-->
        <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="logoutModal" role="dialog" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Ready to Leave?
                        </h5>
                        <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                            <span aria-hidden="true">
                                ×
                            </span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Select "Logout" below if you are ready to end your current session.
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal" type="button">
                            Cancel
                        </button>
                        <a class="btn btn-primary" href="login.html">
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}">
        </script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}">
        </script>
        <!-- Core plugin JavaScript-->
        <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}">
        </script>
        <!-- Custom scripts for all pages-->
        <script src="{{ asset('js/sb-admin-2.min.js') }}">
        </script>
        <!-- Page level plugins -->
        <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}">
        </script>
        <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}">
        </script>
        <!-- Page level custom scripts -->
        <script src="{{ asset('js/demo/datatables-demo.js') }}">
        </script>
        <script type="text/javascript">
            $(window).resize(function() {
             $('#page-top').addClass('sidebar-toggled');
             $('#accordionSidebar').removeClass();
             $('#accordionSidebar').addClass('navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled');
            });
            
        </script>
    </body>
</html>
