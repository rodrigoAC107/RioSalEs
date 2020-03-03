@extends('layouts.app')

@section('content')


  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block">
                  <img src="{{ asset('img/logo.png') }}" style=" background-position: center; background-size: cover; width: 130%; height: 100%;padding-top: 10%">
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <div class="d-xl-none d-lg-none">
                    <img src="{{ asset('img/logo.png') }}" style=" background-position: center; background-size: cover; width: 65%; margin-top: -10%">
                    </div>
                    <h1 class="h4 text-gray-900 mb-4">Bienvenido!</h1>
                  </div>
                  <form class="user" method="POST" action="{{ route('login') }}" autocomplete="off">
                    @csrf
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Email">
                        @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" id="exampleInputPassword" placeholder="Contraseña">

                       @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                       @enderror
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Recuerdame') }}
                        </label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                    {{ __('Iniciar Sesión') }}
                    </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    @if (Route::has('password.request'))
                      <a class="btn btn-link" href="{{ route('password.request') }}">
                          {{ __('Olvidaste la contraseña?') }}
                      </a>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

@endsection
