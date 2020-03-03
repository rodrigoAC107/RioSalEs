@extends('layouts.app2')


@section('content')
<!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Nomina de Usuarios</h6>
            </div>
            <div class="d-flex justify-content-center text-center text-uppercase pb-3 py-3">
              @include('includes.guardado')
              </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nombre</th>
                      <th>Apellido</th>
                      <th>Email</th>
                      <th>Rol</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                     @foreach($usuarios as $usuario)
                        
                        <td>{{$usuario->nombre}}</td>
                        <td>{{$usuario->apellido}}</td>
                        <td>{{$usuario->email}}</td>
                        <td>{{$usuario->roles->nombre}}</td>
                        <td class="text-center">
                          @if(Auth::user()->email!= $usuario->email)
                          <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-info m-1"><i class="far fa-edit"></i></a>
                          @endif
                          @if(Auth::user()->email!= $usuario->email)
                          <a href="{{ route('usuarios.delete', $usuario->id) }}" class="btn btn-danger m-1"
                            onclick=" return confirm('Desea eliminar el registro?')"><i class="fas fa-trash"></i></a>
                          @endif
                        </td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>


@endsection