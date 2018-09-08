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
			@if(!Auth::user()->isAdmin() && !Auth::user()->isPatient())
				<li>
					<a href="{{route('panel.users.index')}}">  سایر کاربران</a>
				</li>
			@endif
			@if(Auth::user()->isPatient())
				<li>
					<a href="{{route('panel.users.index', ['group_code' => User::G_DOCTOR])}}"> پزشکان</a>
				</li>
				<li>
					<a href="{{route('panel.users.index', ['group_code' => User::G_NURSE])}}"> پرستاران</a>
				</li>
			@endif
		</ul>
	</li>
	<li>
		<a href="#healthunitmenu" data-toggle="collapse" aria-expanded="false">
			<i class="fa fa-hospital-o" aria-hidden="false"></i>
			<span>
			واحد‌های درمانی
			</span>
		</a>
		<ul class="collapse list-unstyled" id="healthunitmenu">
			<li>
				<a href="#hospitals" data-toggle="collapse" aria-expanded="false">
					<span>بیمارستان‌ها</span>
				</a>
				<ul class="collapse list-unstyled" id="hospitals">
					@if(Auth::user()->isAdmin() || Auth::user()->isManager())
						<li>
							<a href="{{route('panel.hospitals.create')}}"> بیمارستان جدید</a>
						</li>
					@endif
					<li>
						<a href="{{route('panel.hospitals.index')}}"> لیست بیمارستان ها</a>
					</li>
					@if(!(Auth::user()->isPatient() || Auth::user()->isAdmin()))
						<li>
							<a href="{{route('panel.hospitals.index', ['joined' => true])}}"> بیمارستان‌های من</a>
						</li>
					@endif
				</ul>
			</li>
			<li>
				<a href="#policlinics" data-toggle="collapse" aria-expanded="false">
					<span>درمانگاه‌ها</span>
				</a>
				<ul class="collapse list-unstyled" id="policlinics">
					@if(Auth::user()->isAdmin() || Auth::user()->isManager())
						<li>
							<a href="{{route('panel.policlinics.create')}}"> درمانگاه جدید</a>
						</li>
					@endif
					<li>
						<a href="{{route('panel.policlinics.index')}}"> لیست درمانگاه ها</a>
					</li>
					@if(!(Auth::user()->isPatient() || Auth::user()->isAdmin()))
						<li>
							<a href="{{route('panel.policlinics.index', ['joined' => true])}}"> درمانگاه‌های من</a>
						</li>
					@endif
				</ul>
			</li>
			<li>
				<a href="#clinics" data-toggle="collapse" aria-expanded="false">
					<span>مطب‌ها</span>
				</a>
				<ul class="collapse list-unstyled" id="clinics">
					@if(Auth::user()->isAdmin() || Auth::user()->isDoctor())
						<li>
							<a href="{{route('panel.clinics.create')}}"> مطب جدید</a>
						</li>
					@endif
					<li>
						<a href="{{route('panel.clinics.index')}}"> لیست مطب ها</a>
					</li>
					@if(!(Auth::user()->isPatient() || Auth::user()->isAdmin() || Auth::user()->isManager()))
						<li>
							<a href="{{route('panel.clinics.index', ['joined' => true])}}"> مطب‌های من</a>
						</li>
					@endif
				</ul>
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
			@if(Auth::user()->isDoctor() || Auth::user()->isNurse())
				<li>
					<a href="{{route('panel.departments.index', ['joined' => true])}}"> بخش‌های من</a>
				</li>
			@endif
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
			<a href="#unit-user-requests" data-toggle="collapse" aria-expanded="false">
				<i class="fa fa-user-md" aria-hidden="false"></i>
				<span>
				درخواست‌‌های عضویت
				</span>
			</a>
			<ul class="collapse list-unstyled" id="unit-user-requests">
				<li>
					<a href="{{route('panel.unit_users.index')}}"> لیست درخواست‌ها</a>
				</li>
				<li>
					<a href="#unit-user-new" data-toggle="collapse" aria-expanded="false"><span>عضو جدید</span></a>
					<ul class="collapse list-unstyled" id="unit-user-new">
						<li>
							kjdnvkjn
						</li>
					</ul>
				</li>
			</ul>
		</li>
	@endif
	<li>
		<a href="#patient-requests" data-toggle="collapse" aria-expanded="false">
			<i class="fa fa-stethoscope" aria-hidden="false"></i>
			<span>
			درخواست‌های دسترسی
			</span>
		</a>
		<ul class="collapse list-unstyled" id="patient-requests">
			@if(!Auth::user()->isPatient() && !Auth::user()->isManager() && !Auth::user()->isAdmin())
				<li>
					<a href="{{route('panel.permissions.create')}}"> درخواست جدید</a>
				</li>
			@endif
			@if(!Auth::user()->isAdmin())
				<li>
					<a href="{{route('panel.permissions.index')}}">  درخواست‌های من</a>
				</li>
			@else
				<li>
					<a href="{{route('panel.permissions.index')}}">  درخواست‌ها</a>
				</li>
			@endif
		</ul>
	</li>
</ul>