@extends('layouts.main')
@section('title', 'داشبورد')
@section('content')
<div class="row">
    @if(!Auth::user()->isAdmin())
        @dashboard_wallet
    @else
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
@endsection
