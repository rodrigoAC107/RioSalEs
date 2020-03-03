@extends('layouts.app2')

@section('content')
<div class="card">
    <div class="card-head">
        <div class="container">
            <div class="py-3">
                <center>
                    <nav class="navbar navbar-expand-lg navbar-dark bg-primary w-75">
                        <button aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarText" data-toggle="collapse" type="button">
                            <span class="navbar-toggler-icon">
                            </span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarText">
                            <ul class="navbar-nav mr-auto">
                                <li>
                                    <a class="nav-link collapsed" href="{{route('empleado.informacion')}}">
                                        Informacion Personal
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link collapsed" href="{{route('dieta.create')}}">
                                        Dietas
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link collapsed" href="{{route('alergia.create')}}">
                                        Alergias
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link collapsed" href="{{route('antecedentePersonal.create')}}">
                                        Antecedentes personales
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link collapsed" href="{{route('antecedenteFamiliar.create')}}">
                                        Antecedentes familiares
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link collapsed" href="{{route('habitos.create')}}">
                                        Habitos
                                    </a>
                                </li>
                                <li class="nav-item">
                                <a class="nav-link collapsed" href="{{ route('documentacion.index')}}">
                                        Estudios
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </center>
            </div>
        </div>
        <div class="container-fluid">
            <main class="py-4">
                @yield('contenido')
            </main>
        </div>
    </div>
</div>
@endsection
