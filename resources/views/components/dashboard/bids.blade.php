@php
    use App\Models\Bid;
    $all_bids = Bid::where('user_id', Auth::user()->id)->count();
    $remain_bids = Bid::where('user_id', Auth::user()->id)->where('status', Bid::PENDING)->count();
@endphp
<div class="col-md-4 col-sm-6 col-xs-12 pull-right">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-8 col-md-8 col-xs-8">
                    <span>ماموریت‌ها: {{$all_bids}} عدد</span>
                    <br>
                    <span>ماموریت‌های انجام نشده:  {{$remain_bids}}عدد</span>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <img src="{{asset('/imgs/007-scalpel.svg')}}">
                </div>
            </div>
        </div>
    </div>
</div>