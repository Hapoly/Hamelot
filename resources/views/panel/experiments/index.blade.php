@extends('layouts.main')
@section('title', __('experiments.index'))
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
                <div class="form-group">
                  <select class="form-control" name="status" id="status" style="width: 100%">
                    <option value="0">تمام وضعیت‌ها</option>
                    <option value="1" {{isset($filters)? ($filters['status'] == 1? 'selected': '') : ''}}>{{__('units.status_str.1')}}</option>
                    <option value="2" {{isset($filters)? ($filters['status'] == 2? 'selected': '') : ''}}>{{__('units.status_str.2')}}</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <select class="form-control" name="unit_id" id="unit_id" style="width: 100%">
                    <option value="0">تمام واحد‌های درمانی</option>
                    @foreach($units as $unit)
                      <option {{isset($filters)? ($filters['unit_id'] == $unit->id? 'selected': ''): ''}} value="{{$unit->id}}">{{$unit->complete_title}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              @filter_city(['province_id' => isset($filters)? $filters['province_id']: 0, 'city_id' => isset($filters)? $filters['city_id']: 0])
            </div>
            <div class="row" style="margin-bottom:2px;margin-top:2px;">
              <div class="col-md-6" style="text-align: left">
                <a style="margin: 0px 5px" class="btn btn-default" href="{{route('panel.prints.experiments.index', [$search, 'page' => $experiments->currentPage()])}}">{{__('experiments.print_this_page')}}</a>
                <a style="margin: 0px 5px" class="btn btn-default" href="{{route('panel.prints.experiments.index', [$search, 'page' => 0])}}">{{__('experiments.print_all')}}</a>
              </div>
              <div class="col-md-6">
                <button class="btn btn-info" type="submit">{{__('experiments.search')}}</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row" style="margin-bottom:50px;">
  @if(sizeof($experiments))
    <table class="table table-bordered">
      <thead>
        <tr>
          <th >{{__('experiments.row')}}</th>
          <th >{{__('experiments.title')}}</th>
          <th >{{__('experiments.user_id')}}</th>
          <th >{{__('experiments.date')}}</th>
          <th >{{__('experiments.unit_id')}}</th>
          <th >{{__('experiments.operation')}}</th>
        </tr>
      </thead>
      <tbody>
        @foreach($experiments as $index => $experiment)
          <tr>
          <td>{{$index+1}}</td>
          <td><a href="{{route('panel.experiments.show', ['experiment' => $experiment])}}">{{$experiment->report_template->title}}</a></td>
          <td><a href="{{route('panel.users.show', ['user' => $experiment->user])}}">{{$experiment->user->full_name}}</a></td>
          <td>{{$experiment->date_str}}</td>
          <td>{{$experiment->unit->title}}</td>
          <td>
            @if($experiment->has_permission_to_write)
              @operation_th(['base' => 'panel.experiments', 'label' => 'experiment', 'item' => $experiment, 'remove_label' => __('experiments.remove'), 'edit_label' => __('experiments.edit'), 'show_label' => __('experiments.show')])
            @else
              <a class="btn btn-default" herf="{{route('panel.experiments.show', ['experiment' => $experiment])}}">{{__('experiments.show')}}</a>
            @endif
          </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @else
    <div class="row">
      <div class="col-md-12" style="text-align: center">
        {{__('experiments.not_found')}}
      </div>
    </div>
  @endif
  @pagination(['links' => $experiments->links()])
</div>
@endsection
