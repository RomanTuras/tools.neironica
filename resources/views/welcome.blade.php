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
            .start-btn {
                border: 1px solid #cecece;
                padding: 10px 40px;
                border-radius: 20px;
                font-size: 18px;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                text-decoration: none;
                color: #636b6f;
                transition: all 1s ease;
            }
            .start-btn:hover {
                color: #000;
                background-color: #efefef;
            }

        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    <a href="/puzzle">Пазлы</a>
                    @auth

                    @else
                        <a href="{{ route('login') }}">{{ __('auth.login') }}</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">{{ __('auth.register') }}</a>
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
                        <p style="margin-bottom: 40px;">Разбуди свой интеллект!</p>
                        @can('isAdmin')
                            <a href="{{ url('/admin') }}" class="start-btn">НАЧАЛО РАБОТЫ</a>
                        @elsecan('isTeacher')
                            <a href="{{ url('/teacher') }}" class="start-btn">НАЧАЛО РАБОТЫ</a>
                        @elsecan('isStudent')
                            <a href="{{ url('/student') }}" class="start-btn">НАЧАЛО РАБОТЫ</a>
                        @endcan
                    @else
                        <p>Зарегистрируйтесь или войдите для дальнейшей работы</p>
                    @endauth
                    
                </div>

            </div>
        </div>
    </body>
</html>
