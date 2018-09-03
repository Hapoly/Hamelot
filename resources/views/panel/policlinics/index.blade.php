@extends('layouts.main')
@section('title', __('policlinics.index_title'))
@section('content')
<div class="row" style="margin-bottom:50px;">
  <div class="col-md-4 col-sm-3">
    @if(Auth::user()->isAdmin() || Auth::user()->isManager())
      <a href="{{route('panel.policlinics.create')}}" class="btn add"> {{__('policlinics.create')}}</a>
    @endif
  </div>
    <div class="col-md-8 col-sm-9">
      <form class="navbar-form" role="search" style="margin:auto;width:100%;direction:ltr;float:right" action="{{route('panel.policlinics.index',['sort' => $sort])}}" method="get">
        <div class="input-group add-on">
          <div class="input-group-btn">
            <button class="btn" type="submit"><i class="glyphicon glyphicon-search"></i></button>
          </div>
          <input class="form-control search-box" placeholder="{{__('policlinics.search')}}"  name="search" id="srch-term" value="{{old('search')}}" type="text">
        </div>
      </form>
    </div>
  </div>
  @table([
    'route' => 'panel.policlinics.index', 
    'hasAny' => sizeof($policlinics) > 0, 
    'not_found' => __('policlinics.not_found'),
    'items' => $policlinics, 
    'search'  => $search,
    'cols' => [
      'id'          => __('policlinics.row'),
      'title'       => __('policlinics.title'),
      'city'        => __('policlinics.city_id'),
      'phone'       => __('policlinics.phone'),
      'mobile'      => __('policlinics.mobile'),
      'status'      => __('policlinics.status'),
      'NuLL'        => __('policlinics.operation'),
    ]])
    @foreach($policlinics as $policlinic)
      <tr class="policlinic-td {{$policlinic->joined? 'tr-highlight': ''}}">
        <td>{{$policlinic->id}}</td>
        <td><a href="{{route('panel.policlinics.show', ['$policlinic' => $policlinic])}}">{{$policlinic->title}}</a></td>
        <td>{{$policlinic->city->title}}</td>
        <td>{{$policlinic->phone_str}}</td>
        <td>{{$policlinic->mobile_str}}</td>
        <td>{{$policlinic->status_str}}</td>
        @if(Auth::user()->isAdmin())
          @operation_th(['base' => 'panel.policlinics', 'label' => 'policlinic', 'item' => $policlinic, 'remove_label' => __('policlinics.remove'), 'edit_label' => __('policlinics.edit')])
        @else
          <td><a class="btn btn-default" href="{{route('panel.policlinics.show', ['$policlinic' => $policlinic])}}">{{__('policlinics.show')}}</a></td>
        @endif
      </tr>
    @endforeach
  @endtable
  @pagination(['links' => $policlinics->links()])
</div>
@endsection
