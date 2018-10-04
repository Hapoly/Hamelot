@extends('layouts.main')
@section('title', __('units.index_title'))
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
                    <option value="1" {{isset($filters)? ($filters['status'] == 1? 'selected': '') : ''}}>{{__('units.status_str.1')}}</option>
                    <option value="2" {{isset($filters)? ($filters['status'] == 2? 'selected': '') : ''}}>{{__('units.status_str.2')}}</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row" style="margin-top: 0px; margin-bottom: 0xp;">
              <div class="checkbox">
                <input class="checkbox-input" name="root" type="checkbox" value="true" {{isset($filters)? ($filters['root']? 'checked': ''): ''}}>
                <label class="checkbox-label" >فقط نمایش واحده‌های ریشه</label>
              </div>
            </div>
            <div class="row" style="margin-top: 0px">
              <div class="checkbox">
                <input class="checkbox-input" name="joined" type="checkbox" value="true" {{isset($filters)? ($filters['joined']? 'checked': ''): ''}}>
                <label class="checkbox-label" >واحد‌های من</label>
              </div>
            </div>
            <div class="row" style="margin-bottom:2px;margin-top:2px;">
              <div class="col-md-6" style="text-align: left">
                <a style="margin: 0px 5px" class="btn btn-default" href="{{route('panel.prints.units.index', [$search, 'page' => $units->currentPage()])}}">{{__('units.print_this_page')}}</a>
                <a style="margin: 0px 5px" class="btn btn-default" href="{{route('panel.prints.units.index', [$search, 'page' => 0])}}">{{__('units.print_all')}}</a>
              </div>
              <div class="col-md-6">
                <button class="btn btn-info" type="submit">{{__('units.search')}}</button>
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
    'route' => 'panel.units.index', 
    'hasAny' => sizeof($units) > 0, 
    'not_found' => __('units.not_found'),
    'items' => $units,
    'search'  => $search,
    'cols' => [
      'id'          => __('units.row'),
      'title'       => __('units.title'),
      'group_code'  => __('units.group_code'),
      'address'     => __('units.city_id'),
      'status'      => __('units.status'),
      'NuLL'        => __('units.operation'),
    ]])
    @foreach($units as $index => $unit)
      <tr class="unit-td {{$unit->joined? 'tr-highlight': ''}}">
        <td>{{$index+1}}</td>
        <td><a href="{{route('panel.units.show', ['hospit$unit' => $unit])}}">{{$unit->title}}</a></td>
        <td>{{$unit->group_str}}</td>
        <td>{{$unit->city->title}}</td>
        <td>{{$unit->status_str}}</td>
        @if(Auth::user()->isAdmin())
          <td>
            @operation_th(['base' => 'panel.units', 'label' => 'unit', 'item' => $unit, 'remove_label' => __('units.remove'), 'edit_label' => __('units.edit'), 'show_label' => __('units.show')])
          </td>
        @else
          <td><a class="btn btn-default" href="{{route('panel.units.show', ['$unit' => $unit])}}">{{__('units.show')}}</a></td>
        @endif
      </tr>
    @endforeach
  @endtable
  @pagination(['links' => $units->links()])
</div>
@endsection
