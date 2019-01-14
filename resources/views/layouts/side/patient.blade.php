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
		<a href="{{route('home')}}">
			<i class="fa fa-dashboard" aria-hidden="false"></i>
			<span>پیشخوان</span>
		</a>
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
		<a href="{{route('panel.permissions.index')}}">
			<i class="fa fa-stethoscope" aria-hidden="false"></i>
			<span>  درخواست‌های من</span>
		</a>
	</li>
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
	<li>
		<a href="{{route('panel.bids.index')}}" aria-expanded="false">
			<i class="fa fa-stethoscope" aria-hidden="false"></i>
			<span>نوبت‌های ویزیت من</span>
		</a>
	</li>
	<li>
		<a href="{{route('panel.transactions.index')}}" aria-expanded="false">
			<i class="fa fa-credit-card" aria-hidden="false"></i>
			<span>تراکنش‌های مالی</span>
		</a>
	</li>
</ul>