@extends('layouts.main')
@section('title', __('clinics.index_title'))
@section('content')
<div class="row" style="margin-bottom:50px;">
  <div class="col-md-4 col-sm-3">
    @if(Auth::user()->isAdmin() || Auth::user()->isManager())
      <a href="{{route('panel.clinics.create')}}" class="btn add"> {{__('clinics.create')}}</a>
    @endif
  </div>
    <div class="col-md-8 col-sm-9">
      <form class="navbar-form" role="search" style="margin:auto;width:100%;direction:ltr;float:right" action="{{route('panel.clinics.index',['sort' => $sort])}}" method="get">
        <div class="input-group add-on">
          <div class="input-group-btn">
            <button class="btn" type="submit"><i class="glyphicon glyphicon-search"></i></button>
          </div>
          <input class="form-control search-box" placeholder="{{__('clinics.search')}}"  name="search" id="srch-term" value="{{old('search')}}" type="text">
        </div>
      </form>
    </div>
  </div>
  @table([
    'route' => 'panel.clinics.index', 
    'hasAny' => sizeof($clinics) > 0, 
    'not_found' => __('clinics.not_found'),
    'items' => $clinics, 
    'search'  => $search,
    'cols' => [
      'id'          => __('clinics.row'),
      'doctor_id'   => __('clinics.doctor_id'),
      'city'        => __('clinics.city_id'),
      'phone'       => __('clinics.phone'),
      'mobile'      => __('clinics.mobile'),
      'status'      => __('clinics.status'),
      'NuLL'        => __('clinics.operation'),
    ]])
    @foreach($clinics as $clinic)
      <tr class="clinic-td {{$clinic->joined? 'tr-highlight': ''}}">
        <td>{{$clinic->id}}</td>
        <td><a href="{{route('panel.clinics.show', ['$clinic' => $clinic])}}">{{$clinic->doctor->full_name}}</a></td>
        <td>{{$clinic->city->title}}</td>
        <td>{{$clinic->phone_str}}</td>
        <td>{{$clinic->mobile_str}}</td>
        <td>{{$clinic->status_str}}</td>
        @if($clinic->has_permission)
          @operation_th(['base' => 'panel.clinics', 'label' => 'clinic', 'item' => $clinic, 'remove_label' => __('clinics.remove'), 'edit_label' => __('clinics.edit'), 'show_label' => __('clinics.show')])
        @else
          <td><a class="btn btn-default" href="{{route('panel.clinics.show', ['$clinic' => $clinic])}}">{{__('clinics.show')}}</a></td>
        @endif
      </tr>
    @endforeach
  @endtable
  @pagination(['links' => $clinics->links()])
</div>
@endsection
