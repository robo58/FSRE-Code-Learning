<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Fsre-Code-Learning</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div>
            <b-navbar toggleable="lg" type="dark" variant="info">
                <b-navbar-brand href="{{ url('/') }}">Fsre-Code-Learning</b-navbar-brand>

                <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

                <b-collapse id="nav-collapse" is-nav>
                    <b-navbar-nav>
                    </b-navbar-nav>

                    <!-- Right aligned nav items -->
                    <b-navbar-nav class="ml-auto">
                        @guest
                            <b-nav-item href="{{ route('login') }}">
                                Login
                            </b-nav-item>
                            @if (Route::has('register'))
                            <b-nav-item href="{{ route('register') }}">
                                Register
                            </b-nav-item>
                            @endif
                        @else
                            <b-nav-item-dropdown right>
                                <!-- Using 'button-content' slot -->
                                <template v-slot:button-content>
                                    <em>{{ Auth::user()->name }} <span class="caret"></span></em>
                                </template>
                                <b-dropdown-item href="{{ route('logout') }}"
                                                 onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    Logout
                                </b-dropdown-item>
                            </b-nav-item-dropdown>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endguest
                    </b-navbar-nav>
                </b-collapse>
            </b-navbar>
        </div>
        <main>
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>

