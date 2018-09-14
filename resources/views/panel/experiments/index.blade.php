@extends('layouts.main')
@section('title', __('experiments.index'))
@section('content')
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
        @foreach($experiments as $experiment)
          <tr>
          <td>{{$experiment->id}}</td>
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
