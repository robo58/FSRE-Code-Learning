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
                @guest
                    <b-navbar-brand href="{{ url('/') }}">Fsre-Code-Learning</b-navbar-brand>
                @else
                    <b-navbar-brand href="{{ url('/home') }}">Fsre-Code-Learning</b-navbar-brand>
                @endguest

                <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

                <b-collapse id="nav-collapse" is-nav>

                    {{-- Left aligned nav items --}}
                    <b-navbar-nav>
                        <b-nav-item href="/categories">Categories</b-nav-item>
                    </b-navbar-nav>
                    <b-navbar-nav>
                        <b-nav-item href="/courses">Courses</b-nav-item>
                    </b-navbar-nav>
                    <b-navbar-nav>
                        <b-nav-item href="/teachers">Teachers</b-nav-item>
                    </b-navbar-nav>
                    <b-navbar-nav>
                        <b-nav-item href="/students">Students</b-nav-item>
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
                            <search-bar></search-bar>
                            <b-nav-item-dropdown right>
                                <!-- Using 'button-content' slot -->
                                <template v-slot:button-content>
                                     <em><img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="height: 32px; width: 32px; position: relative; border-radius: 50%;">{{ Auth::user()->name }}</em>
                                </template>
                                @can('manage-users')
                                <b-dropdown-item href="{{ route('superadmin.users.index') }}"><b-icon-people-fill></b-icon-people-fill> User Management</b-dropdown-item>
                                @endcan
                                <b-dropdown-item href="{{ route('profile',\Illuminate\Support\Facades\Auth::user()) }}"><b-icon-person-fill></b-icon-person-fill> Profile</b-dropdown-item>
                                <b-dropdown-item href="{{ route('inbox') }}"><b-icon-inbox-fill></b-icon-inbox-fill> Inbox</b-dropdown-item>
                                <b-dropdown-item href="#" @click.prevent="$refs.logout.submit()"><b-icon-box-arrow-right></b-icon-box-arrow-right> Logout</b-dropdown-item>
                                <form ref="logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </b-nav-item-dropdown>
                        @endguest
                    </b-navbar-nav>
                </b-collapse>
            </b-navbar>

        </div>
        <main>
                @include('partials.alerts')
                @yield('content')

        </main>
    </div>
    <script src="https://cdn.tiny.cloud/1/kvm3r8ah3dzqtleksdugz6masv1858dk8t7qzvpvy81456na/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</body>
</html>

