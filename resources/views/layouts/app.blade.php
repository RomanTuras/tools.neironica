<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Neironica') }}</title>
    <meta name="description" content="Tools for Neironica">
    <meta name="author" content="Roman Turas, TurasStudio">
    <meta name="viewport" content="width=device-width">

    <link rel="icon" href="../img/@2x/favicon.png">

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="../img/@2x/favicon.png" width="16" height="16" class="d-inline-block align-top" alt="">
                    {{ config('app.name', 'Neironica') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

{{--                Creating App Bar--}}
                @if(isset($data))
                    @if($data['page'] == 'students.home')
                        @include('appbars.home-student')
                    @elseif($data['page'] == 'students.vocabulary-add' || $data['page'] == 'students.vocabulary-exercise')
                        @include('appbars.vocabulary')
                        @endif
                    @else
                @include('appbars.start')
                    @endif

            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="../js/app.js"></script>
    <script src="../js/scripts.min.js"></script>
    
</body>
</html>
