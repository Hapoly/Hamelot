@php
    use App\Models\Demand;
    $all_demands = Demand::whereHas('unit', function($query){
        return $query->whereHas('managers', function($query){
            return $query->where('users.id', Auth::user()->id);
        });
    })->count();
    $closed_demands = Demand::whereHas('unit', function($query){
        return $query->whereHas('managers', function($query){
            return $query->where('users.id', Auth::user()->id);
        });
    })->whereIn('status', [
        Demand::DONE,
        Demand::CANCELED,
        Demand::UNIT_USER_CANCELED,
        Demand::PATIENT_CENCELED,
        Demand::NO_BID_FOUND,
        Demand::UNIT_REFUSED,
        Demand::USER_REFUSED,
    ])->count();
@endphp
<div class="col-md-4 col-sm-6 col-xs-12 pull-right">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-8 col-md-8 col-xs-8">
                    <span>تقاضاها: {{$all_demands}} عدد</span>
                    <br>
                    <span>تقاضاهای بسته: {{$closed_demands}}عدد</span>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <img src="{{asset('/imgs/005-management.svg')}}">
                </div>
            </div>
        </div>
    </div>
</div>