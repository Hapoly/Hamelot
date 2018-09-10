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
                    <option {{isset($filters)? ($filters['group_code'] == User::G_ADMIN? 'selected': ''): ''}} value="{{User::G_ADMIN}}">ادمین</option>
                    <option {{isset($filters)? ($filters['group_code'] == User::G_MANAGER? 'selected': ''): ''}} value="{{User::G_MANAGER}}">مدیریت</option>
                    <option {{isset($filters)? ($filters['group_code'] == User::G_DOCTOR? 'selected': ''): ''}} value="{{User::G_DOCTOR}}">دکتر</option>
                    <option {{isset($filters)? ($filters['group_code'] == User::G_NURSE? 'selected': ''): ''}} value="{{User::G_NURSE}}">پرستار</option>
                    <option {{isset($filters)? ($filters['group_code'] == User::G_PATIENT? 'selected': ''): ''}} value="{{User::G_PATIENT}}">بیمار</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6" id="departments">
                @if(isset($filters['hospital']))
                  <div class="form-group">
                    <select class="form-control" name="unit_id" style="width: 100%">
                      <option value="0" {{$filters['unit_id'] ? 'selected': ''}}>تمام بخش‌ها</option>
                      @foreach($filters['hospital']->departments as $department)
                        <option value="{{$department->id}}" {{$filters['unit_id'] == $department->id? 'selected': ''}}>{{$department->title}}</option>
                      @endforeach
                    </select>
                  </div>
                @endif
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <select class="form-control" name="hospital_id" id="hospital-id" style="width: 100%">
                    <option value="0">همه بیمارستان ها</option>
                    @foreach($hospitals as $hospital)
                      <option value="{{$hospital->id}}" {{$filters['hospital_id'] == $hospital->id? 'selected': ''}}>{{$hospital->title}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row" id="more-inputs"></div>
            <div class="row" style="margin-bottom:2px;margin-top:2px;">
              <div class="col-md-12">
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
            <th><a href="{{route('panel.users.index')}}">{{__('users.row')}}</a></th>
            <th><a href="{{route('panel.users.index')}}">{{__('users.username')}}</a></th>
            <th><a href="{{route('panel.users.index')}}">{{__('users.group_code')}}</a></th>
            <th><a href="{{route('panel.users.index')}}">{{__('users.first_name')}}</a></th>
            <th><a href="{{route('panel.users.index')}}">{{__('users.last_name')}}</a></th>
            <th><a href="{{route('panel.users.index')}}">{{__('users.status')}}</a></th>
            <th >{{__('users.operation')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
            <tr class="user-td">
              <td>{{$user->id}}</td>
              <td><a href="{{route('panel.users.show', ['user' => $user])}}">{{$user->username}}</a></td>
              <td>{{$user->group_str}}</td>
              <td>{{$user->first_name}}</td>
              <td>{{$user->last_name}}</td>
              <td>{{$user->status_str}}</td>
              <td>
                @if(Auth::user()->isAdmin())
                  <td>
                    @operation_th(['base' => 'panel.users', 'label' => 'user', 'item' => $user, 'remove_label' => __('users.remove'), 'edit_label' => __('users.edit_str'), 'show_label' => __('users.show')])
                  </td>
                @else
                  غیر قابل دسترسی
                @endif
              </td>
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
      console.log('test');
      switch($('#group-code').val()){
        case "{{User::G_DOCTOR}}":
          $('#more-inputs').html(
            '<div class="col-md-6">'+
            '    <div class="form-group">'+
            '      <select class="form-control" name="doctor_degree" style="width: 100%">'+
            '        <option value="0">تمام سطوح</option>'+
            '        @foreach($doctor_degrees as $degree)'+
            '          <option value="{{$degree->id}}">{{$degree->value}}</option>'+
            '        @endforeach'+
            '      </select>'+
            '    </div>'+
            '  </div>'+
            '  <div class="col-md-6">'+
            '    <div class="form-group">'+
            '      <select class="form-control" name="doctor_field" style="width: 100%">'+
            '        <option value="0">تمام تخصص‌ها</option>'+
            '        @foreach($doctor_fields as $field)'+
            '          <option value="{{$field->id}}">{{$field->value}}</option>'+
            '        @endforeach'+
            '      </select>'+
            '    </div>'+
            '  </div>'
          );
          break;
        case "{{User::G_NURSE}}":
          $('#more-inputs').html(
            '<div class="col-md-6">'+
            '    <div class="form-group">'+
            '      <select class="form-control" name="nurse_degree" style="width: 100%">'+
            '        <option value="0">تمام سطوح</option>'+
            '        @foreach($nurse_degrees as $degree)'+
            '          <option value="{{$degree->id}}">{{$degree->value}}</option>'+
            '        @endforeach'+
            '      </select>'+
            '    </div>'+
            '  </div>'+
            '  <div class="col-md-6">'+
            '    <div class="form-group">'+
            '      <select class="form-control" name="nurse_field" style="width: 100%">'+
            '        <option value="0">تمام تخصص‌ها</option>'+
            '        @foreach($nurse_fields as $field)'+
            '          <option value="{{$field->id}}">{{$field->value}}</option>'+
            '        @endforeach'+
            '      </select>'+
            '    </div>'+
            '  </div>'
          );
          break;
        default:
          $('#more-inputs').html('');
          break;
      }
      switch($('#group-code').val()){
        case "{{User::G_DOCTOR}}":
        case "{{User::G_NURSE}}":
        case "{{User::G_PATIENT}}":
          $('#gender-input').html(
            '<div class="form-group">'+
            '  <select class="form-control" name="gender" style="width: 100%">'+
            '    <option value="0">تمام جنسیت‌ها</option>'+
            '    @foreach($genders as $gender)'+
            '      <option value="{{$gender->id}}">{{$gender->value}}</option>'+
            '    @endforeach'+
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
        $('#more-inputs').html(
          '<div class="col-md-6">'+
          '    <div class="form-group">'+
          '      <select class="form-control" name="doctor_degree" style="width: 100%">'+
          '        <option value="0">تمام سطوح</option>'+
          '        @foreach($doctor_degrees as $degree)'+
          '          <option {{isset($filters)? ($filters["doctor_degree"] == $degree->id ? "selected": ""): ""}} value="{{$degree->id}}">{{$degree->value}}</option>'+
          '        @endforeach'+
          '      </select>'+
          '    </div>'+
          '  </div>'+
          '  <div class="col-md-6">'+
          '    <div class="form-group">'+
          '      <select class="form-control" name="doctor_field" style="width: 100%">'+
          '        <option value="0">تمام تخصص‌ها</option>'+
          '        @foreach($doctor_fields as $field)'+
          '          <option {{isset($filters)? ($filters["doctor_field"] == $field->id ? "selected": ""): ""}} value="{{$field->id}}">{{$field->value}}</option>'+
          '        @endforeach'+
          '      </select>'+
          '    </div>'+
          '  </div>'
        );
        break;
      case "{{User::G_NURSE}}":
        $('#more-inputs').html(
          '<div class="col-md-6">'+
          '    <div class="form-group">'+
          '      <select class="form-control" name="nurse_degree" style="width: 100%">'+
          '        <option value="0">تمام سطوح</option>'+
          '        @foreach($nurse_degrees as $degree)'+
          '          <option {{isset($filters)? ($filters["nurse_degree"] == $degree->id ? "selected": ""): ""}} value="{{$degree->id}}">{{$degree->value}}</option>'+
          '        @endforeach'+
          '      </select>'+
          '    </div>'+
          '  </div>'+
          '  <div class="col-md-6">'+
          '    <div class="form-group">'+
          '      <select class="form-control" name="nurse_field" style="width: 100%">'+
          '        <option value="0">تمام تخصص‌ها</option>'+
          '        @foreach($nurse_fields as $field)'+
          '          <option {{isset($filters)? ($filters["nurse_field"] == $field->id ? "selected": ""): ""}} value="{{$field->id}}">{{$field->value}}</option>'+
          '        @endforeach'+
          '      </select>'+
          '    </div>'+
          '  </div>'
        );
        break;
      default:
        $('#more-inputs').html('');
        break;
    }
    switch($('#group-code').val()){
      case "{{User::G_DOCTOR}}":
      case "{{User::G_NURSE}}":
      case "{{User::G_PATIENT}}":
        $('#gender-input').html(
          '<div class="form-group">'+
          '  <select class="form-control" name="gender" style="width: 100%">'+
          '    <option value="0">تمام جنسیت‌ها</option>'+
          '    @foreach($genders as $gender)'+
          '      <option {{isset($filters)? ($filters["gender"] == $gender->id ? "selected": ""): ""}} value="{{$gender->id}}">{{$gender->value}}</option>'+
          '    @endforeach'+
          '  </select>'+
          '</div>'
        );
        break;
      default:
        $('#gender-input').html('');
        break;
    }

    // departments

    $('#hospital-id').change(function(){
      if($('#hospital-id').val() == 0){
        $('#departments').html('');
        return;
      }
      var settings = {
        "async": true,
        "crossDomain": true,
        "url": "{{route('api.panel.departments')}}",
        "method": "POST",
        "headers": {
          "content-type": "application/json"
        },
        "processData": false,
        "data": "{\"hospital_id\": "+ $('#hospital-id').val() +"}"
      }
      $.ajax(settings).done(function (response) {
        let departments = '';
        for(let i=0; i<response.length; i++)
          departments += '<option value="'+ response[i].id +'">'+ response[i].title +'</option>';
        $('#departments').html(
          '<div class="form-group">'+
          '  <select class="form-control" name="unit_id" style="width: 100%">'+
          '    <option value="0">تمام بخش‌ها</option>'+ departments+
          '  </select>'+
          '</div>'
        );
      });
    })
  })
</script>
@endsection
