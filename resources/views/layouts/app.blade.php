<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @hasSection('title')
            {{ trans('pages.application.title') }} - @yield('title')
        @else
            {{ trans('pages.application.title') }}
        @endif
    </title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" rel='stylesheet'
          type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <meta name="token" content="{{ csrf_token() }}">
</head>
<body id="app">
    <nav class="navbar navbar-light bg-faded">
        <div class="container">
            <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                &#9776;
            </button>

            <div class="collapse navbar-toggleable-xs" id="app-navbar-collapse">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ trans('pages.application.title') }}
                </a>

                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">
                            {{ trans('pages.navbar.home') }}
                        </a>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav pull-xs-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/login') }}">
                                {{ trans('pages.navbar.login') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/register') }}">
                                {{ trans('pages.navbar.register') }}
                            </a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button"
                               aria-expanded="false">
                                {{ Auth::user()->has_filled_profile ? Auth::user()->profile->first_name : Auth::user()->username }}
                                <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" role="menu">
                                <a class="dropdown-item" href="{{ route('dashboard.index') }}">
                                    <span class="fa fa-btn fa-user"></span> Tableau de bord
                                </a>
                                <a class="dropdown-item" href="{{ url('/logout') }}">
                                    <span class="fa fa-btn fa-sign-out"></span> {{ trans('pages.navbar.logout') }}
                                </a>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

@yield('content')

<!-- JavaScript -->
    <script src="/js/main.js"></script>

    @stack('scripts')
</body>
</html>
