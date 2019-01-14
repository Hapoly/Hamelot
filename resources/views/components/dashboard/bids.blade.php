@php
  use App\Models\Bid;
  $all_bids = Bid::where('user_id', Auth::user()->id)->count();
  $remain_bids = Bid::where('user_id', Auth::user()->id)
    ->whereNotIn('status', [Bid::PENDING, Bid::DONE, Bid::CANCELED, Bid::ACCEPTED_PAID_ALL, Bid::REFUSED])
    ->count();
@endphp
<div class="col-md-4 col-sm-6 col-xs-12 pull-right">
  <div class="panel panel-default">
    <div class="panel-body">
      <div class="row">
        <div class="col-md-8 col-md-8 col-xs-8">
          @if(Auth::user()->isDoctor())
            <span>نوبت ها: {{$all_bids}} عدد</span>
          @else
            <span>ماموریت‌ها: {{$all_bids}} عدد</span>
          @endif
          <br>
          <span>نوبت های درجریان:  {{$remain_bids}}عدد</span>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-4">
          <img src="{{asset('/imgs/007-scalpel.svg')}}">
        </div>
      </div>
    </div>
  </div>
</div>