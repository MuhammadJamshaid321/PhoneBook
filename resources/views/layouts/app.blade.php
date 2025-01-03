<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main {
            flex: 1;
        }
        footer {
            margin-top: auto;
        }
    </style>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-secondary bg-secondary white shadow-sm">
            <div class="container">
                
                <a class="navbar-brand text-light" href="">
                    {{ __('Phone_Book_App') }}
                </a>
                <a class="navbar-brand" href="{{ route('dashboard.home') }}">
                    {{ __('Dashboard') }}
                </a>
                @can('view permissions')
                <a class="navbar-brand" href="{{ route('permissions.index') }}">
                    {{ __('Permissions') }}
                </a>
                @endcan
                @can('view roles')
                <a class="navbar-brand" href="{{ route('roles.index') }}">
                    {{ __('Roles') }}
                </a>
                @endcan
                @can('view contacts')
                <a class="navbar-brand" href="{{ route('contacts.index') }}">
                    {{ __('PhoneBook') }}
                </a>
                @endcan
                @can('view users')
                <a class="navbar-brand" href="{{ route('users.index') }}">
                    {{ __('Users') }}
                </a>
                @endcan
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <footer class="bg-secondary py-3">
        <div class="container text-center">
            <p class="mb-1">&copy; 2024 PhoneBook. Vizrex Solution (Private) Limited.</p>
            <a href="#" class="text-decoration-none text-dark me-3">Privacy Policy</a>
            <a href="#" class="text-decoration-none text-dark me-3">Terms of Service</a>
            <a href="#" class="text-decoration-none text-dark">Contact Us</a>
        </div>
    </footer>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
 @isset($script)
     {{ $script }}
 @endisset
</html>
