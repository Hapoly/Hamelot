@extends('layouts.main')
@section('title', __('hospitals.index_title'))
@section('content')
<div class="filter-panel">
  <div class="row justify-content-center">
    <div class="col-8">
      <div class="panel panel-default">
        <div class="panel-heading">جستجو</div>
        <div class="panel-body">
          <form>
            <div class="row">
              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">آدرس</span>
                  <input type="text" class="form-control" value="{{isset($filters)? $filters['address']: ''}}" name="address" placeholder="خیابان شهربازی">
                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group">
                  <span class="input-group-addon">نام بیمارستان</span>
                  <input type="text" class="form-control" value="{{isset($filters)? $filters['title']: ''}}" name="title" placeholder="هفده شهریور">
                </div>
              </div>
            </div>
            <div class="row">
              @filter_city(['province_id' => isset($filters)? $filters['province_id']: 0, 'city_id' => isset($filters)? $filters['city_id']: 0])
            </div>
            <div class="row" style="margin-top: 15px">
              <div class="col-md-6"></div>
              <div class="col-md-6">
                <div class="form-group">
                  <select class="form-control" name="status" id="status" style="width: 100%">
                    <option value="0">تمام وضعیت‌ها</option>
                    <option value="1" {{isset($filters)? ($filters['status'] == 1? 'selected': '') : ''}}>{{__('hospitals.status_str.1')}}</option>
                    <option value="2" {{isset($filters)? ($filters['status'] == 2? 'selected': '') : ''}}>{{__('hospitals.status_str.2')}}</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row" style="margin-bottom:2px;margin-top:2px;">
              <div class="col-md-6" style="text-align: left">
                <a style="margin: 0px 5px" class="btn btn-default" href="{{route('panel.prints.hospitals.index', [$search, 'page' => $hospitals->currentPage()])}}">{{__('hospitals.print_this_page')}}</a>
                <a style="margin: 0px 5px" class="btn btn-default" href="{{route('panel.prints.hospitals.index', [$search, 'page' => 0])}}">{{__('hospitals.print_all')}}</a>
              </div>
              <div class="col-md-6">
                <button class="btn btn-info" type="submit">{{__('hospitals.search')}}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row" style="margin-bottom:50px;">
  @table([
    'route' => 'panel.hospitals.index', 
    'hasAny' => sizeof($hospitals) > 0, 
    'not_found' => __('hospitals.not_found'),
    'items' => $hospitals,
    'search'  => $search,
    'cols' => [
      'id'          => __('hospitals.row'),
      'title'       => __('hospitals.title'),
      'address'     => __('hospitals.city_id'),
      'phone'       => __('hospitals.phone'),
      'mobile'      => __('hospitals.mobile'),
      'status'      => __('hospitals.status'),
      'NuLL'        => __('hospitals.operation'),
    ]])
    @foreach($hospitals as $hospital)
      <tr class="hospital-td {{$hospital->joined? 'tr-highlight': ''}}">
        <td>{{$hospital->id}}</td>
        <td><a href="{{route('panel.hospitals.show', ['hospit$hospital' => $hospital])}}">{{$hospital->title}}</a></td>
        <td>{{$hospital->city->title}}</td>
        <td>{{$hospital->phone}}</td>
        <td>{{$hospital->mobile}}</td>
        <td>{{$hospital->status_str}}</td>
        @if(Auth::user()->isAdmin())
          <td>
            @operation_th(['base' => 'panel.hospitals', 'label' => 'hospital', 'item' => $hospital, 'remove_label' => __('hospitals.remove'), 'edit_label' => __('hospitals.edit'), 'show_label' => __('hospitals.show')])
          <td>
        @else
          <td><a class="btn btn-default" href="{{route('panel.hospitals.show', ['$hospital' => $hospital])}}">{{__('hospitals.show')}}</a></td>
        @endif
      </tr>
    @endforeach
  @endtable
  @pagination(['links' => $hospitals->links()])
</div>
@endsection
