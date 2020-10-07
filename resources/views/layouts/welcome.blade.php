<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Phonenumbers</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
            <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <style>
        * {
            box-sizing: border-box;
        }
        nav {
            min-height: 10vh;
            max-height: 10vh;
            text-transform: uppercase;
        }
        main {
            min-height: 89.9vh;
            max-height: 89.9vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url("{{ asset('/images/bg.png') }}");
            background-size: cover;
            background-repeat: no-repeat;
        }
        .nav-item {
            display: flex;
            align-items: center;
        }
        .loged-in-nav a{
            margin-right: 15px;
        }
        </style>
    </head>
    <body>
    <header>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <div class="loged-in-nav">
                                    <a href="{{ url('/phonenumbers') }}">Phonenumbers</a>
                                </div>
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
    </header>
    <main>
        @section('content')
        @show

        @section('main_page')
        @show

        @section('phonenumbers')
        @show
    </main>
    <script src="{{asset('js/app.js')}}"></script>
        <!-- https://stackoverflow.com/questions/43090063/how-to-get-data-from-database-to-view-page-in-laravel -->
    </body>
</html>
