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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<!-- Our Custom CSS -->
	<link rel="stylesheet" href="{{asset('css/style.css')}}?v={{hash_file('md5', 'css/style.css')}}">
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
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>  
	<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCF40Q8udTOhpGY3FSk17gr_-9tQTchliY"></script>
</head>
<body>
	<div class="wrapper" class="toggled">
		<!-- Sidebar Holder -->
		<nav id="sidebar">
			<div class="sidebar-header">
				<h3>Hamelot</h3>
				<strong style="font-size:20px;">
				`
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
										<a href="#">{{Auth::user()->prefix}} {{ Auth::user()->first_name }} {{Auth::user()->last_name}}</a>
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
							</div>
						</div>
					</div>
					
					
				</div>
			</nav>
			<div class="container">
				@yield('content')
			</div>
		</div>
	</div>
	<footer class="container-fluid bg-4 text-center">
		<p style="margin-top:15px;color:white;">design by
			<a href="https://github.com/Hapoly">hapoly</a>
		</p>
	</footer>
	<script type="text/javascript">
		$(document).ready(function () {
			$('#sidebarCollapse').on('click', function () {
				$('#sidebar').toggleClass('active');
			});
		});
	</script>
	<script>
	function appendcard() {
    var txt1 = "<p>Text.</p>";            
    $(".test").prepend('#testcard');   
	}
	</script>
</body>

</html>