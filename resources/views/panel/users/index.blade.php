@extends('layouts.main')
@section('title', __('users.index.title'))
@section('content')
<?php
  use App\User;
?>
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
                  <span class="input-group-addon">نام خانوادگی</span>
                  <input type="text" class="form-control" value="{{isset($filters)? $filters['last_name']: ''}}" name="last_name" placeholder="ناصحی">
                </div>
              </div>
              <div class="col-md-6">            
                <div class="input-group">
                  <span class="input-group-addon">نام</span>
                  <input type="text" class="form-control" value="{{isset($filters)? $filters['first_name']: ''}}" name="first_name" placeholder="احمد">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6" id="gender-input">
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <select class="form-control" name="group_code" id="group-code" style="width: 100%">
                    <option value="0">تمام گروه‌های کاربری</option>
                    @if(Auth::user()->isAdmin())
                      <option {{isset($filters)? ($filters['group_code'] == User::G_ADMIN? 'selected': ''): ''}} value="{{User::G_ADMIN}}">ادمین</option>
                    @endif
                    @if(Auth::user()->isAdmin() || Auth::user()->isManager())
                    <option {{isset($filters)? ($filters['group_code'] == User::G_MANAGER? 'selected': ''): ''}} value="{{User::G_MANAGER}}">مدیریت</option>
                    @endif
                    <option {{isset($filters)? ($filters['group_code'] == User::G_DOCTOR? 'selected': ''): ''}} value="{{User::G_DOCTOR}}">دکتر</option>
                    <option {{isset($filters)? ($filters['group_code'] == User::G_NURSE? 'selected': ''): ''}} value="{{User::G_NURSE}}">پرستار</option>
                    <option {{isset($filters)? ($filters['group_code'] == User::G_PATIENT? 'selected': ''): ''}} value="{{User::G_PATIENT}}">بیمار</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row" id="more-inputs"></div>
            <div class="row" style="margin-bottom:2px;margin-top:2px;">
              <div class="col-md-6" style="text-align: left">
                <a style="margin: 0px 5px" class="btn btn-default" href="{{route('panel.prints.users.index', [$search, 'page' => $users->currentPage()])}}">{{__('users.print_this_page')}}</a>
                <a style="margin: 0px 5px" class="btn btn-default" href="{{route('panel.prints.users.index', [$search, 'page' => 0])}}">{{__('users.print_all')}}</a>
              </div>
              <div class="col-md-6">
                <button class="btn btn-info" type="submit">{{__('users.search')}}</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  @if(sizeof($users))
    <div class="col-10">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>{{__('users.row')}}</th>
            @if(Auth::user()->isAdmin())
                <th><a href="{{route('panel.users.index')}}">{{__('users.username')}}</a></th>
            @endif
            <th><a href="{{route('panel.users.index')}}">{{__('users.first_name')}}</th>
            <th><a href="{{route('panel.users.index')}}">{{__('users.last_name')}}</th>
            <th><a href="{{route('panel.users.index')}}">{{__('users.group_code')}}</th>
            <th><a href="{{route('panel.users.index')}}">{{__('users.status')}}</th>
            <th >{{__('users.operation')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $index => $user)
            <tr class="user-td">
              <td>{{$index+1}}</td>
              @if(Auth::user()->isAdmin())
                <td><a href="{{route('panel.users.show', ['user' => $user])}}">{{$user->username}}</a></td>
              @endif
              <td>{{$user->first_name_str}}</td>
              <td>{{$user->last_name_str}}</td>
              <td>{{$user->group_str}}</td>
              <td>{{$user->status_str}}</td>
                @if(Auth::user()->isAdmin())
                  <td>
                    @operation_th_rg(['base' => 'panel.users', 'label' => 'user', 'item' => $user, 'remove_label' => __('users.remove'), 'edit_label' => __('users.edit_str'), 'show_label' => __('users.show')])
                  </td>
                @else
                  <td>
                    @if(Auth::user()->can('write_info', $user))
                      <a href="{{route('panel.users.edit', ['user' => $user])}}" class="btn btn-primary">{{__('users.edit_str')}}</a>
                    @endif
                    <a href="{{route('panel.users.show', ['user' => $user])}}" class="btn btn-default">{{__('users.show')}}</a>
                  </td>
                @endif
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @else
  <div class="col-md-12" style="text-align: center">
    {{__('users.no_found')}}
  </div>
  @endif
  @pagination(['links' => $links])
</div>
<script>
  $(document).ready(function(){
    function update_form(){
      switch($('#group-code').val()){
        case "{{User::G_DOCTOR}}":
        case "{{User::G_NURSE}}":
        case "{{User::G_PATIENT}}":
          $('#gender-input').html(
            '<div class="form-group">'+
            '  <select class="form-control" name="gender" style="width: 100%">'+
            '    <option value="0">تمام جنسیت‌ها</option>'+
            '    <option {{isset($filters)? ($filters["gender"] == 1 ? "selected": ""): ""}} value="{{1}}">{{__('users.gender_str.1')}}</option>'+
            '    <option {{isset($filters)? ($filters["gender"] == 2 ? "selected": ""): ""}} value="{{2}}">{{__('users.gender_str.2')}}</option>'+
            '  </select>'+
            '</div>'
          );
          break;
        default:
          $('#gender-input').html('');
          break;
      }
    }
    $('#group-code').change(function(){
      update_form();
    })
    switch($('#group-code').val()){
      case "{{User::G_DOCTOR}}":
      case "{{User::G_NURSE}}":
      case "{{User::G_PATIENT}}":
        $('#gender-input').html(
          '<div class="form-group">'+
          '  <select class="form-control" name="gender" style="width: 100%">'+
          '    <option value="0">تمام جنسیت‌ها</option>'+
          '    <option {{isset($filters)? ($filters["gender"] == 1 ? "selected": ""): ""}} value="{{1}}">{{__('users.gender_str.1')}}</option>'+
          '    <option {{isset($filters)? ($filters["gender"] == 2 ? "selected": ""): ""}} value="{{2}}">{{__('users.gender_str.2')}}</option>'+
          '  </select>'+
          '</div>'
        );
        break;
      default:
        $('#gender-input').html('');
        break;
    }
  })
</script>
@endsection
