<ul class="list-unstyled components">
	<li>
		<a href="{{route('welcome')}}">
			<i class="fa fa-home" aria-hidden="false"></i>
			<span>صفحه اصلی</span>
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
			<li><a href="{{route('panel.units.create.clinic')}}">مطب جدید</a></li>
		</ul>
	</li>
</ul>