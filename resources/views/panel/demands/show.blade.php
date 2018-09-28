@extends('layouts.main')
@section('title', $demand->description)
@section('content')
<div class="container">
  <div class="row">
    <h2>{{__('demands.index_title')}}</h2>
  </div>
  <div class="panel panel-default">
    <div class="row">
      <table class="table table-striped">
        <tbody>
          <tr>
            <td>{{__('demands.description')}}</td>
            <td>{{$demand->description}}</td>
          </tr>
          <tr>
            <td>{{__('demands.patient_id')}}</td>
            <td>{{$demand->patient->full_name}}</td>
          </tr>
          @if($demand->address_id == 0)
            <tr>
              <td>{{__('demands.address_type')}}
              <td>{{__('demands.no_place')}}</td>
            </tr>
          @else
            <tr>
              <td>{{__('addresses.province_id')}}</td>
              <td>{{$demand->address->city->province->title}}</td>
            </tr>
            <tr>
              <td>{{__('addresses.city_id')}}</td>
              <td>{{$demand->address->city->title}}</td>
            </tr>
            <tr>
              <td>{{__('addresses.plain')}}</td>
              <td>{{$demand->address->plain}}</td>
            </tr>
            <tr>
              <td>{{__('addresses.cordinate_link')}}</td>
              <td><a target="_blank" href="https://www.google.com/maps/{{'@' .$demand->address->lon}},{{$demand->address->lat}},18z">{{__('addresses.show_on_gmaps')}}</a></td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
