@extends('layouts.main')
@section('title', 'داشبورد')
@section('content')
<div class="row">
  @if(!(Auth::user()->isAdmin() || Auth::user()->isPatient()))
    @dashboard_wallet
  @endif
  @if(Auth::user()->isAdmin())
    @dashboard_users
  @endif
  @if(!Auth::user()->isPatient())
    @dashboard_units
  @endif
  @if(Auth::user()->isDoctor() || Auth::user()->isNurse() || Auth::user()->isManager())
    @dashboard_bids
  @endif
</div>
<div class="row">
  @dashboard_open_bids
  @dashboard_last_transactions
</div>
@endsection
