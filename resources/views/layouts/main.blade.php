<!DOCTYPE html>
<html dir="rtl">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Bootstrap CSS CDN -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- Our Custom CSS -->
	<link rel="stylesheet" href="{{asset('css/style.css')}}">
	<link href='http://www.fontonline.ir/css/BRoya.css' rel='stylesheet' type='text/css'>
	<style>
		.row {
			margin-top: 3rem;
			margin-bottom: 1rem;
		}
	</style>
</head>
<body>
	<div class="wrapper" class="toggled">
		<!-- Sidebar Holder -->
		<nav id="sidebar">
			<div class="sidebar-header">
				<h3>Hamelot</h3>
				<strong style="font-size:20px;">
				
				</strong>
			</div>

			<ul class="list-unstyled components">
				<li>
					<a href="#userSubmenu" data-toggle="collapse" aria-expanded="false">
						<i class="fa fa-users" aria-hidden="false"></i>
						مدیریت کاربران
					</a>
					<ul class="collapse list-unstyled" id="userSubmenu">
						<li>
							<a href="{{route('panel.users.create.admin')}}"> ادمین جدید</a>
						</li>
						<li>
							<a href="{{route('panel.users.create.manager')}}"> مدیریت جدید</a>
						</li>
						<li>
							<a href="{{route('panel.users.create.doctor')}}"> دکتر جدید</a>
						</li>
						<li>
							<a href="{{route('panel.users.create.nurse')}}"> پرستار جدید</a>
						</li>
						<li>
							<a href="{{route('panel.users.create.patient')}}"> بیمار جدید</a>
						</li>
						<li>
							<a href="{{route('panel.users.index')}}">  کاربران</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#hospitalSubmenu" data-toggle="collapse" aria-expanded="false">
						<i class="fa fa-hospital-o" aria-hidden="false"></i>
						بیمارستان ها
					</a>
					<ul class="collapse list-unstyled" id="hospitalSubmenu">
						<li>
							<a href="{{route('panel.hospitals.create')}}"> بیمارستان جدید</a>
						</li>
						<li>
							<a href="{{route('panel.hospitals.index')}}"> لیست بیمارستان ها</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#partSubmenu" data-toggle="collapse" aria-expanded="false">
						<i class="fa fa-h-square" aria-hidden="false"></i>
						بخش ها
					</a>
					<ul class="collapse list-unstyled" id="partSubmenu">
						<li>
							<a href="{{route('panel.departments.create')}}"> بخش جدید</a>
						</li>
						<li>
							<a href="{{route('panel.departments.index')}}"> لیست بخش ها</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#testtSubmenu" data-toggle="collapse" aria-expanded="false">
						<i class="fa fa-medkit" aria-hidden="true"></i>
						آزمایشات
					</a>
					<ul class="collapse list-unstyled" id="testtSubmenu">
						<!-- <li>
							<a href="#"> آزمایش جدید</a>
						</li> -->
						<li>
							<a href="{{route('panel.test')}}"> لیست آزمایشات</a>
						</li>
					</ul>
				</li>
			</ul>
		</nav>
		<!-- Page Content Holder -->
		<div id="content" style="width:100%">
			<nav class="navbar navbar-default">
				<div class="container-fluid">	
					<div class="navbar-header navbar-right">
						<button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
							<i class="glyphicon glyphicon-align-right"></i>
							 <!-- <span>Toggle</span>  -->
						</button>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-left">
							<li>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
								<a class="exit" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('general.logout') }}</a>
							</li>
							<li>
								<a href="#">{{Auth::user()->prefix}} {{ Auth::user()->first_name }} {{Auth::user()->last_name}}</a>
							</li>
						</ul>
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
	<!-- jQuery CDN -->
	<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
	<!-- Bootstrap Js CDN -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			$('#sidebarCollapse').on('click', function () {
				$('#sidebar').toggleClass('active');
			});
		});
	</script>
</body>

</html>