<?php
	use App\User;
?>
<ul class="list-unstyled components">
	<li>
		<a href="#userSubmenu" data-toggle="collapse" aria-expanded="false">
			<i class="fa fa-users" aria-hidden="false"></i>
			<span>
			کاربران
			</span>
		</a>
		<ul class="collapse list-unstyled" id="userSubmenu">
			@if(Auth::user()->isAdmin())
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
			@endif
			@if(Auth::user()->isManager())
				<li>
					<a href="{{route('panel.users.index')}}">  کاربران</a>
				</li>
			@endif
			@if(Auth::user()->isDoctor() || Auth::user()->isNurse())
				<li>
					<a href="{{route('panel.users.index', ['group_code' => User::G_PATIENT])}}">  بیماران من</a>
				</li>
			@endif
			@if(!Auth::user()->isAdmin())
				<li>
					<a href="{{route('panel.users.index')}}">  سایر کاربران</a>
				</li>
			@endif
		</ul>
	</li>
	<li>
		<a href="#hospitalSubmenu" data-toggle="collapse" aria-expanded="false">
			<i class="fa fa-hospital-o" aria-hidden="false"></i>
			<span>
			بیمارستان ها
			</span>
		</a>
		<ul class="collapse list-unstyled" id="hospitalSubmenu">
			@if(Auth::user()->isAdmin())
			<li>
				<a href="{{route('panel.hospitals.create')}}"> بیمارستان جدید</a>
			</li>
			@endif
			<li>
				<a href="{{route('panel.hospitals.index')}}"> لیست بیمارستان ها</a>
			</li>
		</ul>
	</li>
	<li>
		<a href="#partSubmenu" data-toggle="collapse" aria-expanded="false">
			<i class="fa fa-h-square" aria-hidden="false"></i>
			<span>
			بخش ها
			</span>
		</a>
		<ul class="collapse list-unstyled" id="partSubmenu">
			@if(Auth::user()->isAdmin() || Auth::user()->isManager())
				<li>
					<a href="{{route('panel.departments.create')}}"> بخش جدید</a>
				</li>
			@endif
			<li>
				<a href="{{route('panel.departments.index')}}"> لیست بخش ها</a>
			</li>
		</ul>
	</li>
	<li>
		<a href="#testtSubmenu" data-toggle="collapse" aria-expanded="false">
			<i class="fa fa-medkit" aria-hidden="true"></i>
			<span>
			آزمایشات
			</span>
		</a>
		<ul class="collapse list-unstyled" id="testtSubmenu">
			<li>
				<a href="{{route('panel.experiments.index')}}"> لیست آزمایشات</a>
			</li>
			<li>
				<a href="{{route('panel.report_templates.index')}}"> لیست قالب‌ها</a>
			</li>
			@if(Auth::user()->isAdmin())
				<li>
					<a href="{{route('panel.report_templates.create')}}"> قالب جدید</a>
				</li>
			@endif
		</ul>
	</li>
	@if(Auth::user()->isManager() || Auth::user()->isAdmin())
		<li>
			<a href="#partSubmenu" data-toggle="collapse" aria-expanded="false">
				<i class="fa fa-h-square" aria-hidden="false"></i>
				<span>
				درخواست‌‌های عضویت
				</span>
			</a>
			<ul class="collapse list-unstyled" id="partSubmenu">
				<li>
					<a href="{{route('panel.department_users.index')}}"> لیست درخواست‌ها</a>
				</li>
			</ul>
		</li>
	@endif
</ul>