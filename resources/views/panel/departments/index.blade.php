@extends('layouts.main')
@section('title', __('departments.index_title'))
@section('content')
<div class="row" style="margin-bottom:50px;">
  <div class="col-md-4 col-sm-3">
    <a href="{{route('panel.departments.create')}}" class="btn add"> {{__('departments.create')}}</a>
  </div>
  <div class="col-md-8 col-sm-9">
    <form class="navbar-form" role="search" style="margin:auto;width:100%;direction:ltr;float:right" action="{{route('panel.departments.index',['sort' => $sort])}}" method="get">
      <div class="input-group add-on">
        <div class="input-group-btn">
          <button class="btn" type="submit">
          {{__('departments.search')}}
          <!-- <i class="glyphicon glyphicon-search"></i> -->
          </button>
        </div>
        <input class="form-control search-box" placeholder="{{__('departments.index_title')}}"  name="search" id="srch-term" value="{{old('search')}}" type="text">
      </div>
    </form>
  </div>
  </div>
    @table([
      'route' => 'panel.departments.index', 
      'hasAny' => sizeof($departments), 
      'not_found' => __('departments.not_found'),
      'items' => $departments, 
      'search'  => $search,
      'cols' => [
        'id'          => __('departments.row'),
        'title'       => __('departments.title'),
        'hospital_id' => __('departments.hospital_id'),
        'status'      => __('departments.status'),
        'NuLL'        => __('departments.operation'),
      ]])
      @foreach($departments as $department)
        <tr>
          <td>{{$department->id}}</td>
          <td><a href="{{route('panel.departments.show', ['department' => $department])}}">{{$department->title}}</a></td>
          <td><a href="{{route('panel.hospitals.show', ['hospital' => $department->hospital])}}">{{$department->hospital->title}}</a></td>
          <td>{{$department->status_str}}</td>
          @operation_th(['base' => 'panel.departments', 'label' => 'department', 'item' => $department, 'remove_label' => __('departments.remove'), 'edit_label' => __('departments.edit')])
        </tr>
      @endforeach
    @endtable
  </div>
  @pagination(['links' => $departments->links()])
@endsection
