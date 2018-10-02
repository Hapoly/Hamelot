<?php
	use App\User;
	use App\Models\UnitUser;
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
					<a href="{{route('panel.users.index', ['joined' => true])}}">  کاربران</a>
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
			<li><a href="{{route('panel.units.index')}}">لیست واحدها</a></li>
			@if(Auth::user()->isAdmin() || Auth::user()->isManager())
				<li><a href="{{route('panel.units.create')}}">واحد جدید</a></li>
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
				<li><a href="{{route('panel.unit_users.index')}}"> لیست درخواست‌ها</a></li>
				<li><a href="{{route('panel.unit_users.create.manager')}}"> مدیر جدید</a></li>
				<li><a href="{{route('panel.unit_users.create.member')}}"> پرسنل جدید</a></li>
			</ul>
		</li>
	@endif
	@if(!Auth::user()->isManager())
		<li>
			<a href="#patient-requests" data-toggle="collapse" aria-expanded="false">
				<i class="fa fa-stethoscope" aria-hidden="false"></i>
				<span>
				درخواست‌های دسترسی
				</span>
			</a>
			<ul class="collapse list-unstyled" id="patient-requests">
				@if(!Auth::user()->isPatient() && !Auth::user()->isAdmin())
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
	@endif
	@if(Auth::user()->isAdmin() || Auth::user()->isPatient())
		<li>
			<a href="#addresses" data-toggle="collapse" aria-expanded="false">
				<i class="fa fa-map-marker" aria-hidden="false"></i>
				<span>
				آدرس‌ها
				</span>
			</a>
			<ul class="collapse list-unstyled" id="addresses">
				<li>
					<a href="{{route('panel.addresses.create')}}"> آدرس جدید</a>
				</li>
				<li>
					<a href="{{route('panel.addresses.index')}}">  آدرس‌ها</a>
				</li>
			</ul>
		</li>
	@endif
	<li>
		<a href="#demands" data-toggle="collapse" aria-expanded="false">
			<i class="fa fa-heartbeat" aria-hidden="false"></i>
			<span>خدمات پرستاری</span>
		</a>
		<ul class="collapse list-unstyled" id="demands">
			@if(Auth::user()->isPatient())
				<li>
					<a href="{{route('panel.demands.create.free')}}"> تقاضای جدید</a>
				</li>
			@endif
			<li>
				<a href="{{route('panel.demands.index')}}">تفاضاها</a>
			</li>
		</ul>
	</li>
	@if(Auth::user()->isDoctor() || Auth::user()->isNurse())
		<li>
			<a href="{{route('panel.bids.index')}}" aria-expanded="false">
				<i class="fa fa-heartbeat-o" aria-hidden="false"></i>
				<span>ماموریت‌ها</span>
			</a>
		</li>
	@endif
	@if(Auth::user()->isAdmin())
		<li>
			<a href="#transactions" data-toggle="collapse" aria-expanded="false">
				<i class="fa fa-credit-card" aria-hidden="false"></i>
				<span>تراکنش‌های مالی</span>
			</a>
			<ul class="collapse list-unstyled" id="transactions">
				<li>
					<a href="{{route('panel.transactions.create')}}"> تراکنش جدید</a>
				</li>
				<li>
					<a href="{{route('panel.transactions.index')}}">تراکنش‌ها</a>
				</li>
			</ul>
		</li>
	@else
		<li>
			<a href="{{route('panel.transactions.index')}}" aria-expanded="false">
				<i class="fa fa-credit-card" aria-hidden="false"></i>
				<span>تراکنش‌های مالی</span>
			</a>
		</li>
	@endif
</ul>