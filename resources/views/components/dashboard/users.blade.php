@php
    use App\User;
@endphp
<div class="col-md-4 col-sm-6 col-xs-12 pull-right">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-8 col-md-8 col-xs-8">
                    <span>کل کاربران: {{User::count()}}نفر</span>
                    <br>
                    <span>مدیران: {{User::where('group_code', User::G_MANAGER)->count()}}نفر</span>
                    <br>
                    <span>پزشکان و پرستاران:‌ {{User::where('group_code', User::G_DOCTOR)->orWhere('group_code', User::G_NURSE)->count()}}نفر</span>
                    <br>
                    <span>بیماران:‌ {{User::where('group_code', User::G_PATIENT)->count()}} نفر</span>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <img src="{{asset('/imgs/003-man.svg')}}">
                </div>
            </div>
        </div>
    </div>
</div>