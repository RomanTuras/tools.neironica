<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <!-- Left Side Of Navbar -->
    <ul class="navbar-nav mr-auto">

    </ul>

    <!-- Right Side Of Navbar -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item">
            <a class="nav-link" href="{{ url('/students') }}">{{ __('appbar.home') }}</a>
        </li>
        <li class="nav-item {{ ($data['page'] == 'students.vocabulary-add')? 'active':'' }}">
            <a class="nav-link"
               href="{{ url('/students/vocabulary-add') }}">{{ __('appbar.vocabulary-add') }}</a>
        </li>
        <li class="nav-item {{ ($data['page'] == 'students.vocabulary-exercise')? 'active':'' }}">
            <a class="nav-link"
               href="{{ url('/students/vocabulary-exercise') }}">{{ __('appbar.vocabulary-exercise') }}</a>
        </li>

    </ul>
</div>

