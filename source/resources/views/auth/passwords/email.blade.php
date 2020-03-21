<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - @yield('title', 'Login')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="vh-100">
    <div class="container-fluid h-100">
    <div class="row h-100">
        <div class="col-12 d-flex align-content-center justify-content-center flex-wrap bg-light text-dark border-right">


<div class="card border-primary w-50">
    <div class="card-header bg-primary border-primary text-white font-weight-bolder">Recuperar senha</div>

    <div class="card-body">
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">Usuário:</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">Enviar link por email</button>

                    <a class="btn btn-link" href="{{ route('login') }}">Voltar</a>
                </div>
            </div>
        </form>
    </div>
</div>


        </div>
    </div>
    </div>
</body>
</html>
