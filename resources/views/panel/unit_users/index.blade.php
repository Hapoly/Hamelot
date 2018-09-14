@extends('layouts.main')
@section('title', __('unit_users.index_title'))
@section('content')
<?php
  use App\Models\UnitUser;
?>
<div class="row" style="margin-bottom:50px;">
  @table([
    'route' => 'panel.unit_users.index', 
    'hasAny' => sizeof($unit_users) > 0, 
    'not_found' => __('unit_users.not_found'),
    'items' => $unit_users, 
    'search'  => $search,
    'cols' => [
      'id'            => __('unit_users.row'),
      'user_id'       => __('unit_users.user_id'),
      'unit_id'       => __('unit_users.unit_id'),
      'status'        => __('unit_users.status'),
      'NuLL'          => __('unit_users.operation'),
    ]])
    @foreach($unit_users as $unit_user)
      <tr>
        <td>{{$unit_user->id}}</td>
        <td><a href="{{route('panel.users.show', ['user' => $unit_user->user])}}">{{$unit_user->user->full_name}}</a></td>
        <td><a href="{{route('panel.units.show', ['hospital' => $unit_user->unit])}}">{{$unit_user->unit->title}}</a></td>
        <td>{{$unit_user->status_str}}</td>
        <td>
          @if($unit_user->has_manager_permission)
              @if($unit_user->accepted())
                <a class="btn btn-default" href="{{route('panel.unit_users.inline_update', ['unit_user' => $unit_user, 'action' => 'cancel'])}}">{{__('unit_users.cancel')}}</a></td>
              @elseif($unit_user->pending())
                <a class="btn btn-primary" href="{{route('panel.unit_users.inline_update', ['unit_user' => $unit_user, 'action' => 'accept'])}}">{{__('unit_users.accept')}}</a>
                <a class="btn btn-danger" href="{{route('panel.unit_users.inline_update', ['unit_user' => $unit_user, 'action' => 'refuse'])}}">{{__('unit_users.refuse')}}</a>
              @else
                -
              @endif
            </form>
          @else
            <a class="btn btn-default" href="{{route('panel.unit_users.show', ['unit_user' => $unit_user])}}">{{__('unit_users.show')}}</a><
          @endif
        </td>
      </tr>
    @endforeach
  @endtable
  @pagination(['links' => $unit_users->links()])
</div>
@endsection
