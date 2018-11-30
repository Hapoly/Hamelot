<?php
	use App\User;
	use App\Models\UnitUser;
?>
<ul class="list-unstyled components">
	@if(Auth::user()->isDoctor() || Auth::user()->isNurse())
		<li>
			<a href="{{route('show.user', ['username' => Auth::user()->username])}}" aria-expanded="false">
				<i class="fa fa-user" aria-hidden="false"></i>
				<span>صفحه عمومی من</span>
			</a>
		</li>
	@endif
	<li>
		<a href="{{route('home')}}">
			<i class="fa fa-dashboard" aria-hidden="false"></i>
			<span>پیشخوان</span>
		</a>
	</li>
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
					<a href="{{route('panel.users.index', ['joined' => true])}}">  همکاران من</a>
				</li>
				<li>
					<a href="{{route('panel.users.create.doctor')}}"> دکتر جدید</a>
				</li>
				<li>
					<a href="{{route('panel.users.create.nurse')}}"> پرستار جدید</a>
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
		<a href="#experiments" data-toggle="collapse" aria-expanded="false">
			<i class="fa fa-medkit" aria-hidden="true"></i>
			<span>
			آزمایشات
			</span>
		</a>
		<ul class="collapse list-unstyled" id="experiments">
			<li>
				<a href="{{route('panel.experiments.index')}}"> لیست آزمایشات</a>
			</li>
		</ul>
	</li>
	<li>
		<a href="#templates" data-toggle="collapse" arisa-expanded="false">
			<i class="fa fa-folder-open-o" aria-hidden="true"></i>
			<span>
				قالب ها
			</span>
		</a>
		<ul class="collapse list-unstyled" id="templates">
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
	<li>
		<a href="{{route('panel.bids.index')}}" aria-expanded="false">
			<i class="fa fa-stethoscope" aria-hidden="false"></i>
			<span>نوبت ویزیت‌های من</span>
		</a>
	</li>
	@if(Auth::user()->isDoctor())
		<li>
			<a href="{{route('panel.bids.index')}}" aria-expanded="false">
				<i class="fa fa-heart-o" aria-hidden="false"></i>
				<span>ماموریت‌ها</span>
			</a>
		</li>
	@endif
	@if(Auth::user()->isDoctor())
		<li>
			<a href="{{route('panel.bids.index')}}" aria-expanded="false">
				<i class="fa fa-heart-o" aria-hidden="false"></i>
				<span>ویزیت‌های ثبت شده</span>
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
					<a href="{{route('panel.transactions.create.free')}}"> تراکنش آزاد جدید</a>
				</li>
				<li>
					<a href="{{route('panel.transactions.create.withdraw')}}"> تسویه حساب جدید</a>
				</li>
				<li>
					<a href="{{route('panel.transactions.index')}}">تراکنش‌ها</a>
				</li>
			</ul>
		</li>
	@elseif(Auth::user()->isManager())
		<li>
			<a href="#transactions" data-toggle="collapse" aria-expanded="false">
				<i class="fa fa-credit-card" aria-hidden="false"></i>
				<span>تراکنش‌های مالی</span>
			</a>
			<ul class="collapse list-unstyled" id="transactions">
				<li>
					<a href="{{route('panel.transactions.create.withdraw')}}"> تسویه حساب جدید</a>
				</li>
				<li>
					<a href="{{route('panel.transactions.index')}}">تراکنش‌ها</a>
				</li>
				<li>
					<a href="{{route('panel.transactions.pay_off.index')}}">تسویه حساب با پرسنل</a>
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
	@if(Auth::user()->isAdmin() || Auth::user()->isManager())
		<li>
			<a href="#bank-accounts" data-toggle="collapse" aria-expanded="false">
				<i class="fa fa-bank" aria-hidden="false"></i>
				<span>حساب‌های بانکی</span>
			</a>
			<ul class="collapse list-unstyled" id="bank-accounts">
				<li>
					<a href="{{route('panel.bank-accounts.create')}}">حساب بانکی جدید </a>
				</li>
				<li>
					<a href="{{route('panel.bank-accounts.index')}}">حساب‌ها</a>
				</li>
			</ul>
		</li>
	@endif
	@if(!Auth::user()->isPatient())
		@if(Auth::user()->isDoctor())
			<li>
				<a href="#activity-times" data-toggle="collapse" aria-expanded="false">
					<i class="fa fa-calendar-check-o" aria-hidden="false"></i>
					<span>زمانهای نوبت‌دهی</span>
				</a>
				<ul class="collapse list-unstyled" id="activity-times">
					<li>
						<a href="{{route('panel.activity-times.create')}}">زمان نوب‌ت‌دهی جدید </a>
					</li>
					<li>
						<a href="{{route('panel.activity-times.index')}}">زمان‌های نوبت‌دهی</a>
					</li>
				</ul>
			</li>
		@else
			<li>
				<a href="#activity-times" data-toggle="collapse" aria-expanded="false">
					<i class="fa fa-calendar-check-o" aria-hidden="false"></i>
					<span>زمان‌های فعالیت </span>
				</a>
				<ul class="collapse list-unstyled" id="activity-times">
					<li>
						<a href="{{route('panel.activity-times.create')}}">زمان فعالیت جدید </a>
					</li>
					<li>
						<a href="{{route('panel.activity-times.index')}}">زمان‌های فعالیت </a>
					</li>
				</ul>
			</li>
		@endif
		<li>
			<a href="#off-times" data-toggle="collapse" aria-expanded="false">
				<i class="fa fa-calendar-times-o" aria-hidden="false"></i>
				<span>مرخصی</span>
			</a>
			<ul class="collapse list-unstyled" id="off-times">
				<li>
					<a href="{{route('panel.off-times.create')}}">مرخصی جدید </a>
				</li>
				<li>
					<a href="{{route('panel.off-times.index')}}">مرخصی</a>
				</li>
			</ul>
		</li>
	@endif
</ul>