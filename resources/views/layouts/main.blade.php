<!DOCTYPE html>
<?php
	use App\User;
?>
<html dir="rtl">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

	<!-- Bootstrap CSS CDN -->
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">

<!-- Latest compiled and minified JavaScript -->

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<!-- Our Custom CSS -->
	<link rel="stylesheet" href="{{asset('css/style.css')}}?v={{hash_file('md5', Storage::disk('public')->path('css/style.css'))}}">
	<style>
		.row {
			margin-top: 3rem;
			margin-bottom: 1rem;
		}
		.invalid-feedback{
			text-align: right;
		}
	</style>
	<!-- jQuery CDN -->
	<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
	<!-- Bootstrap Js CDN -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
	<!-- jQuery UI CDN -->
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<!-- persian date picker -->
	<link rel="stylesheet" href="{{asset('css/persian-datepicker.min.css')}}"/>
	<script src="{{asset('js/persian-date.min.js')}}"></script>
	<script src="{{asset('js/persian-datepicker.min.js')}}"></script>
	<script type="text/javascript">!function(){function t(){var t=document.createElement("script");t.type="text/javascript",t.async=!0,localStorage.getItem("rayToken")?t.src="https://app.raychat.io/scripts/js/"+o+"?rid="+localStorage.getItem("rayToken")+"&href="+window.location.href:t.src="https://app.raychat.io/scripts/js/"+o;var e=document.getElementsByTagName("script")[0];e.parentNode.insertBefore(t,e)}var e=document,a=window,o="03c5eff6-2946-41d1-b71c-d950fa1eaf56";"complete"==e.readyState?t():a.attachEvent?a.attachEvent("onload",t):a.addEventListener("load",t,!1)}();</script>
</head>
<body>
	<div class="wrapper" class="toggled">
		<!-- Sidebar Holder -->
		<nav id="sidebar">
			<div class="sidebar-header">
				<h3>{{config('app.name', 'Laravel')}}</h3>
				<strong style="font-size:20px;">
				</strong>
			</div>
			@component('layouts.side_menu')
			@endcomponent
		</nav>
		<!-- Page Content Holder -->
		<div id="content" style="width:100%">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="row" style="margin:0;">
						<div class="col-md-6 exit-col">
							<div class="collapse navbar-collapse">
								<ul class="nav navbar-nav navbar-left">
									<li>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											@csrf
										</form>
										<a class="exit" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('general.logout') }}</a>
									</li>
									<li id="login-name">
										<a href="{{route('panel.profile')}}">{{Auth::user()->prefix}} {{ Auth::user()->first_name_str }} {{Auth::user()->last_name_str}}</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="col-md-6 collapse-col">
							<div class="navbar-header navbar-right">
								<button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
									<i class="glyphicon glyphicon-align-right"></i>
									<!-- <span>Toggle</span>  -->
								</button>
								<a class="btn btn-primary" href="{{route('search')}}">{{__('general.search')}}</a>
							</div>
						</div>
					</div>
				</div>
			</nav>
			<div class="container">
				@if(Auth::user()->has_to_complete_profile)
					<div class="alert alert-warning" role="alert">
					{!! __('auth.has_to_complete_profile', ['link' => route('panel.profile')]) !!}
					</div>
				@endif
				@if(Auth::user()->has_to_join_unit)
					<div class="alert alert-warning" role="alert">
					{!! __('auth.has_to_join_unit', ['link' => route('panel.units.create.clinic')]) !!}
					</div>
				@endif
				@yield('content')
			</div>
		</div>
	</div>
	<footer class="container-fluid bg-4 text-center">
		<p style="margin-top:15px;color:white;">designed by
			<a href="https://doctorsoal.com">doctorsoal.com</a>
		</p>
	</footer>
	<script type="text/javascript">
		$(document).ready(function () {
			$('#sidebarCollapse').on('click', function () {
				$('#sidebar').toggleClass('active');
			});
		});
		function appendcard() {
			var txt1 = "<p>Text.</p>";            
			$(".test").prepend('#testcard');   
		}
	</script>
</body>

</html>