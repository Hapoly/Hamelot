@php
    use App\User;
    $users = User::fetch()->orderBy('created_at', 'desc')->limit(5)->get();
@endphp
<div class="panel panel-default" style="margin-top: 10px">
  <div class="panel-heading">{{__('general.last_users')}}</div>
  <div class="panel-body">
    @if(sizeof($users) > 0)
        @table([
            'route' => 'panel.users.index', 
            'hasAny' => sizeof($users) > 0, 
            'not_found' => __('users.not_found'),
            'items' => $users,
            'search'  => '',
            'cols' => [
                'id'          => __('users.row'),
                'username'      => __('users.username'),
                'first_name'        => __('users.first_name'),
                'last_name'    => __('users.last_name'),
                'group_code'        => __('users.group_code'),
                'status'      => __('users.status'),
                'NuLL2'       => __('users.operation'),
            ]
        ])
            @foreach($users as $index => $user)
              <tr class="user-td">
                  <td>{{$index+1}}</td>
                  <td><a href="{{route('panel.users.show', ['user' => $user])}}">{{$user->username}}</a></td>
                  <td>{{$user->first_name}}</td>
                  <td>{{$user->last_name}}</td>
                  <td>{{$user->group_str}}</td>
                  <td>{{$user->status_str}}</td>
                  <td>
                      @operation_th_rg(['base' => 'panel.users', 'label' => 'user', 'item' => $user, 'remove_label' => __('users.remove'), 'edit_label' => __('users.edit_str'), 'show_label' => __('users.show')])
                  </td>
              </tr>
            @endforeach
        @endtable
    @else
        {{users.not_found}}
    @endif
  </div>
</div>