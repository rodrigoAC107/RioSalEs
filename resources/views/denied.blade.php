@extends('layouts.app2')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- 404 Error Text -->
        <div class="text-center">
        <div class="error mx-auto" data-text="403">403</div>
        <p class="lead text-gray-800 mb-5">Acceso denegado</p>
        <p class="text-gray-500 mb-0">Usted no tiene los permisos necesarios...</p>
        <a href="{{route('home')}}">&larr; Volver a inicio</a>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
