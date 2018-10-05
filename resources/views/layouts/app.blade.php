<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
 
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
	<link href='http://www.fontonline.ir/css/BRoya.css' rel='stylesheet' type='text/css'>
    <style>
        body {
            direction: rtl;
        }
        
        th, td {
            text-align: center;
        }

		.invalid-feedback{
			text-align: right;
        }
        @font-face {
            font-family: "IRANSans";
        
            src: url(../fonts/IRANSans-light-web.ttf); 
            /*src: url(../fonts/IRANSans-Medium-web.eot?#iefix) format("embedded-opentype"), url(../fonts/IRANSans-Medium-web.woff)
            format("woff"), url(../fonts/IRANSans-Medium-web.ttf) format("truetype"), url(../fonts/IRANSans-Medium-web.svg#woff2) format("woff2"); */
        }
        *{
            font-family: "IRANSans";
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <!-- <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a> -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('general.login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('general.register') }}</a></li>
                            <li><a class="nav-link" href="{{ route('about') }}">درباره ما</a></li>
                            <li><a class="nav-link" href="{{ route('tour') }}"> الان شروع کن!</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{route('profile')}}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{Auth::user()->prefix}} {{ Auth::user()->first_name }} {{Auth::user()->last_name}} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('general.logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                            <li><a class="nav-link" href="{{route('home')}}">حساب کاربری</a></li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script>
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("mybtn").style.display = "none";
    } else {
        document.getElementById("mybtn").style.display = "block";
    }
}
    </script>
</body>
</html>
