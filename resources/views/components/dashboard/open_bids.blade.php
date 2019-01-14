@php
    use App\User;
    use App\Models\Bid;
    $bids = [];
    if(Auth::user()->isAdmin())
      $bids = Bid::opens()->orderBy('created_at', 'desc')->limit(10)->get();
    if(Auth::user()->isSecretary())
      $bids = Bid::opens()->whereHas('unit', function($query){
        return $query->whereHas('secretaries', function($query){
          return $query->where('users.id', Auth::user()->id);
        });
      })->orderBy('created_at', 'desc')->limit(10)->get();
    if(Auth::user()->isManager())
      $bids = Bid::opens()->whereHas('unit', function($query){
        return $query->whereHas('managers', function($query){
          return $query->where('users.id', Auth::user()->id);
        });
      })->orderBy('created_at', 'desc')->limit(10)->get();
    if(Auth::user()->isDoctor() || Auth::user()->isNurse())
      $bids = Bid::opens()->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->limit(10)->get();
@endphp
<div class="panel panel-default" style="margin-top: 10px">
  <div class="panel-heading">آخرین نوبت های فعال</div>
  <div class="panel-body">
    @if(sizeof($bids) > 0)
      <table class="table table-bordered">
        <thead>
          <th>ردیف</th>
          @if(!Auth::user()->isPatient())
            <th>نام بیمار</th>
          @endif
          @if(Auth::user()->isPatient() || Auth::user()->isManager() || Auth::user()->isSecretary())
            <th>پزشک/پرستار</th>
          @endif
          <th>مرکزدرمانی/مطب</th>
          <th>هزینه</th>
          <th>تاریخ نوبت</th>
          <th>زمان ثبت نوبت</th>
          <th>وضعیت</th>
          <th>عملیات</th>
        </thead>
        <tbody>
          @foreach($bids as $index=>$bid)
            <tr>
              <td>{{$index+1}}</td>
              @if(!Auth::user()->isPatient())
                <td>{{$bid->demand->patient->full_name}}</td>
              @endif
              @if(Auth::user()->isPatient() || Auth::user()->isManager() || Auth::user()->isSecretary())
                <td>{{$bid->user->full_name}}</td>
              @endif
              <td>{{$bid->unit->complete_title}}</td>
              <td>{{$bid->price}}</td>
              <td>{{$bid->date_str}}</td>
              <td>{{$bid->created_at_str}}</td>
              <td>{{$bid->status_str}}</td>
              <td><a class="btn btn-default" href="{{route('panel.bids.show', ['bid' => $bid])}}">مشاهده</a></td>
            </tr>
          @endforeach
        </tbody>
      </table>  
    @else
      <p style="text-align:center">هیچ نوبت جدیدی ثبت نشده است.</p>
    @endif
  </div>
</div>