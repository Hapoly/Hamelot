@extends('layouts.main')
@section('title', __('hospitals.index_title'))
@section('content')
<div class="row" style="margin-bottom:50px;">
  <div class="col-md-4 col-sm-3">
  <a href="{{route('panel.hospitals.create')}}" class="btn add"> بیمارستان جدید</a>
  </div>
    <div class="col-md-8 col-sm-9">
      <form class="navbar-form" role="search" style="margin:auto;width:100%;direction:ltr;float:right" action="{{route('panel.hospitals.index',['sort' => $sort])}}" method="get">
        <div class="input-group add-on">
          <div class="input-group-btn">
            <button class="btn" type="submit"><i class="glyphicon glyphicon-search"></i></button>
          </div>
          <input class="form-control search-box" placeholder="{{__('hospitals.search')}}"  name="search" id="srch-term" value="{{old('search')}}" type="text">
        </div>
      </form>
    </div>
  </div>
  @table([
    'route' => 'panel.hospitals.index', 
    'hasAny' => sizeof($hospitals) > 0, 
    'not_found' => __('hospitals.not_found'),
    'items' => $hospitals, 
    'search'  => $search,
    'cols' => [
      'id'          => __('hospitals.row'),
      'title'       => __('hospitals.title'),
      'address'     => __('hospitals.address'),
      'phone'       => __('hospitals.phone'),
      'mobile'      => __('hospitals.mobile'),
      'status'      => __('hospitals.status'),
      'NuLL'        => __('hospitals.operation'),
    ]])
    @foreach($hospitals as $hospital)
      <tr class="hospital-td">
        <td>{{$hospital->id}}</td>
        <td><a href="{{route('panel.hospitals.show', ['hospit$hospital' => $hospital])}}">{{$hospital->title}}</a></td>
        <td>{{$hospital->address_summary}}</td>
        <td>{{$hospital->phone}}</td>
        <td>{{$hospital->mobile}}</td>
        <td>{{$hospital->status_str}}</td>
        @if(Auth::user()->isAdmin())
          @operation_th(['base' => 'panel.hospitals', 'label' => 'hospital', 'item' => $hospital, 'remove_label' => __('hospitals.remove'), 'edit_label' => __('hospitals.edit')])
        @else
          <td><a class="btn btn-default" href="{{route('panel.hospitals.show', ['hospit$hospital' => $hospital])}}">{{__('hospitals.show')}}</a></td>
        @endif
      </tr>
    @endforeach
  @endtable
  @pagination(['links' => $hospitals->links()])
</div>
@endsection
