@php
    use App\Models\Unit;
@endphp
<div class="col-md-4 col-sm-6 col-xs-12 pull-right">
    <div class="panel panel-default units-panel">
        <div class="panel-body">
            <div class="row" style="margin-top:1rem;">
                <div class="col-md-8 col-md-8 col-xs-8">
                    <div class="row">
                        <div class="col-md-12">
                            <span>واحد‌های درمانی: {{Unit::fetch(true)->count()}} عدد</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <img src="{{asset('/imgs/004-hospital.svg')}}">
                </div>
                <div class="col-md-12">
                    <a class="btn btn-default btn-units" href="{{route('panel.units.index', ['joined' => true])}}">مشاهده واحد‌ها</a>
                </div>
            </div>
        </div>
    </div>
</div>