<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tech-Zone</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/panier.js') }}" defer></script>
    <script src="{{ asset('js/cookies.js') }}" defer></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Exo+2" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/cookies.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet">
    <link href="{{ asset('css/product.css') }}" rel="stylesheet">
    <link href="{{ asset('css/button.css') }}" rel="stylesheet">
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    <link href="{{ asset('css/cart.css') }}" rel="stylesheet">
    <link href="{{ asset('css/panier.css') }}" rel="stylesheet">
</head>
<header>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/catalogue') }}">
                    <img src="http://tech-zone.me/img/logo.png">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="bar">
                    <form class="formulaire"
                          action="{{action('ProductController@search')}}" method="POST" autocomplete="off" name="search">
                        {{csrf_field()}}
                    <input class="champ" type="text" placeholder="Search for something..." name="name" />
                        <i class="fas fa-search searchlogo"></i>
                    </form>
                </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Welcome, <strong>{{ Auth::user()->name }} {{Auth::user()->firstname}}</strong> <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if (Auth::user()->admin== 1)
                                        <a class="dropdown-item" href="/admin">
                                            <i class="fas fa-cogs"></i> Admin
                                        </a>
                                    @endif
                                        <a class="dropdown-item" href="/profile/{{Auth::user()->id}}">
                                            <i class="fas fa-user"></i> Profile
                                        </a>
                                        <a class="dropdown-item" href="/cart/{{Auth::user()->id}}">
                                            <i class="fas fa-shopping-cart"></i> Cart
                                        </a>

                                        <a class="dropdown-item" href="/page_orders/{{Auth::user()->id}}">
                                            <i class="fas fa-history"></i> Orders
                                        </a>

                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                                        </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>

                            </li>
                            @if(Auth::user() != null)
                                <a href="/cart/{{Auth::user()->id}}"><i class="fas fa-shopping-cart" style="font-size: 30px; color:white; margin-right:-100px;">
                                        <div class="cartnbr" id="cartnbr">
                                          <script>
                                          if(localStorage.item == null)
                                              document.write(0);
                                          else
                                              document.write(JSON.parse(localStorage.item).length)
                                          </script></div>
                                    </i></a>
                            @endif

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="navi">
            <ul>
                <a href="{{ url('/catalogue') }}"><li class="liheader">See all the categories</li></a>
                <li>-</li>
                <a href="/catalogue/{{"Phones"}}"><li class="liheader">Phones</li></a>
                <li>-</li>
                <a href="/catalogue/{{"TVs"}}"><li class="liheader">TVs</li></a>
                <li>-</li>
                <a href="/catalogue/{{"Accessories"}}"><li class="liheader">Accessories</li></a>
            </ul>
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

</header>
<body onload="checkCookie()">
  <div id="cookieConsent">
    <div id="closeCookieConsent">x</div>
    Our website is using cookies to improve your browsing. You can see <a href="#" target="_blank">More info</a> about cookies. <a id="cookieaccept" class="cookieConsentOK" onclick="acceptCookie()">Accept Cookies</a>
</div>
</body>
</html>
