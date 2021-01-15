<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Neironica tools</title>
        <meta name="description" content="Tools for Neironica">
        <meta name="author" content="Roman Turas, TurasStudio">
        <meta name="viewport" content="width=device-width">

        <link rel="icon" href="img/@2x/favicon.png">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        @if (\App\User::getRole() == 'admin') {{-- Menu items for administrator --}}
                            <a href="{{ url('/texttools') }}">Начало работы</a>
                        @elseif (\App\User::getRole() == 'student') {{-- Menu items for teachers --}}
                            <a href="{{ url('/students') }}">Начало работы</a>
                        @endif

                    @else
                        <a href="{{ route('login') }}">Войти</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Регистрация</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Neironica
                </div>
                <div class="container">
                    @auth
                        <p>Разбуди свой интеллект!</p>
                    @else
                        <p>Зарегистрируйтесь или войдите для дальнейшей работы</p>
                    @endauth
                    
                </div>

            </div>
        </div>
    </body>
</html>
