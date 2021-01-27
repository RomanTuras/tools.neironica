<nav class="navbar navbar-expand-md navbar-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="../img/@2x/favicon.png" width="16" height="16" class="d-inline-block align-top" alt="">
            {{ config('app.name', 'Neironica') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown" style="flex-grow: 0;">
            <ul class="navbar-nav">

                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('auth.login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('auth.register') }}</a>
                        </li>
                    @endif
                @else

                @if (Auth::user()->role === 'admin' || Auth::user()->role === 'teacher')
                    <li class="nav-item {{ ($data['page'] == 'texttools')? 'active':'' }}">
                        <a class="nav-link" href="@can('isAdmin')/admin @elsecan('isTeacher')/teacher @endcan">Инструменты</a>
                    </li>
                    <li class="nav-item {{ ($data['page'] == 'students')? 'active':'' }}">
                        <a class="nav-link" href="@can('isAdmin')/admin/students @elsecan('isTeacher')/teacher/students @endcan">Студенты</a>
                    </li>
                @endif

                <li class="nav-item dropdown {{ ($data['page'] == 'vocabulary')? 'active':'' }}">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Словарь
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{ url('/vocabulary') }}">Добавить в словарь</a>
                        <a class="dropdown-item" href="{{ url('/vocabulary-exercise') }}">Упражнения</a>
                    </div>
                </li>


                <li id="menu-user-item" class="dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                        <span style="margin-left: 10px;font-size: 12px;color: coral;">
                        @can('isAdmin')(admin)
                        @elsecan('isTeacher')(teacher)
                        @endcan
                    </span>
                        <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                        @can('isAdmin')
                            <a class="dropdown-item" href="@can('isAdmin')/admin/users @elsecan('isTeacher')/teacher/users @endcan">Пользователи</a>
                        @endcan

                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                            {{ __('auth.logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>

                @endguest
            </ul>
        </div>
    </div>
</nav>
