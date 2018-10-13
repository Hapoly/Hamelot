<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
 
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/app.css') }}?v={{hash_file('md5', 'css/app.css')}}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}?v={{hash_file('md5', 'css/login.css')}}" rel="stylesheet">
    
	<!-- jQuery UI CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Bootstrap Js CDN -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
	<!-- persian date picker -->
	<link rel="stylesheet" href="{{asset('css/persian-datepicker.min.css')}}"/>
	<script src="{{asset('js/persian-date.min.js')}}"></script>
	<script src="{{asset('js/persian-datepicker.min.js')}}"></script>
    
    <style>
        .drop {
            display: inherit;
            right: -10px;
        }
        body {
            direction: rtl;
        }
        
        th, td {
            text-align: center;
        }

		.invalid-feedback{
			text-align: right;
        }
        .see-more-btn {
            color: white !important;
        }
        @font-face {
            font-family: "IRANSans";
        
            src: url(../fonts/IRANSans-light-web.ttf); 
            /*src: url(../fonts/IRANSans-Medium-web.eot?#iefix) format("embedded-opentype"), url(../fonts/IRANSans-Medium-web.woff)
            format("woff"), url(../fonts/IRANSans-Medium-web.ttf) format("truetype"), url(../fonts/IRANSans-Medium-web.svg#woff2) format("woff2"); */
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{Auth::user()->prefix}} {{ Auth::user()->first_name }} {{Auth::user()->last_name}} <span class="caret"></span>
                                </a>

                                <div id="drop-down-menu" class="dropdown-menu">
                                    <a class="dropdown-item" href="{{route('panel.profile')}}">پروفایل من</a>
                                    <a class="dropdown-item" href="{{route('home')}}">پیشخوان</a>
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
                            <li></li>
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
        $('#navbarDropdown').click(function(){
            $('#drop-down-menu').toggleClass('drop');
        })
    </script>
</body>
</html>
