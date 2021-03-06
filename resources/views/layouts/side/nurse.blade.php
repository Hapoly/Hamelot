<?php
	use App\User;
	use App\Models\UnitUser;
?>
<ul class="list-unstyled components">
	<li>
		<a href="{{route('welcome')}}">
			<i class="fa fa-home" aria-hidden="false"></i>
			<span>صفحه اصلی</span>
		</a>
	</li>
	<li>
		<a href="{{route('show.user', ['slug' => Auth::user()->slug])}}" aria-expanded="false">
			<i class="fa fa-user" aria-hidden="false"></i>
			<span>صفحه عمومی من</span>
		</a>
	</li>
	<li>
		<a href="{{route('home')}}">
			<i class="fa fa-dashboard" aria-hidden="false"></i>
			<span>پیشخوان</span>
		</a>
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
		</ul>
	</li>
	<li>
		<a href="#patient-requests" data-toggle="collapse" aria-expanded="false">
			<i class="fa fa-stethoscope" aria-hidden="false"></i>
			<span>
			درخواست‌های دسترسی
			</span>
		</a>
		<ul class="collapse list-unstyled" id="patient-requests">
			<li>
				<a href="{{route('panel.permissions.create')}}"> درخواست جدید</a>
			</li>
			<li>
				<a href="{{route('panel.permissions.index')}}">  درخواست‌ها</a>
			</li>
		</ul>
	</li>
	<li>
		<a href="#demands" data-toggle="collapse" aria-expanded="false">
			<i class="fa fa-heartbeat" aria-hidden="false"></i>
			<span>خدمات پرستاری</span>
		</a>
		<ul class="collapse list-unstyled" id="demands">
			<li>
				<a href="{{route('panel.demands.index')}}">تفاضاها</a>
			</li>
		</ul>
	</li>
	<li>
		<a href="#transactions" data-toggle="collapse" aria-expanded="false">
			<i class="fa fa-credit-card" aria-hidden="false"></i>
			<span>تراکنش‌های مالی</span>
		</a>
		<ul class="collapse list-unstyled" id="transactions">
			<!-- <li>
				<a href="{{route('panel.transactions.create.withdraw')}}"> تسویه حساب جدید</a>
			</li> -->
			<li>
				<a href="{{route('panel.transactions.factures.index')}}">صورتحساب</a>
			</li>
			<li>
				<a href="{{route('panel.transactions.index')}}">تراکنش‌ها</a>
			</li>
			<li>
				<a href="{{route('panel.transactions.pay_off.index')}}">تسویه حساب با پرسنل</a>
			</li>
		</ul>
	</li>
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
</ul>