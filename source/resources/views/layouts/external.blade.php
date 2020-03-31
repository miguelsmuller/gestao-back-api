<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - @yield('title', 'Dashboard')</title>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <meta name="theme-color" content="#563d7c">
</head>
<body>
    <div id="app" class="d-flex flex-column">
        <main id="page-content">
            <div class="container text-center">
                <div class="row justify-content-center">
                    <h1 class="display-3  mt-4 text-white">PGI - API</h1>
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>

        @include('layouts.include.footer')
    </div>
</body>
</html>
