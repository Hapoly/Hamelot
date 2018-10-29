@extends('layouts.main')
@section('title', 'داشبورد')
@section('content')
<div class="row">
    @if(!(Auth::user()->isAdmin() || Auth::user()->isPatient() || Auth::user()->isNurse()))
        @dashboard_wallet
    @endif
    @if(Auth::user()->isAdmin())
        @dashboard_users
    @endif
    @if(!Auth::user()->isPatient())
        @dashboard_units
    @elseif(Auth::user()->isDoctor() || Auth::user()->isNurse())
        @dashboard_bids
    @elseif(Auth::user()->isManager())
        @dashboard_demands
    @endif
</div>
<div class="row">
    @if(Auth::user()->isPatient())
        @dashboard_open_bids_patient
    @elseif(Auth::user()->isAdmin())
        @dashboard_open_bids_user
        @dashboard_last_users
    @endif
    @dashboard_last_transactions
</div>
@endsection
