@extends('layouts.app')
@section('title', __('patients.index.title'))
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <a href="{{route('patients.create')}}" class="btn btn-info" role="button">{{__('patients.create')}}</a>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-8">
        <form action="{{route('patients.index',['sort' => $sort])}}" method="get">
          <div class="input-group">
            <input type="text" class="form-control" name="search" value="{{old('search')}}" placeholder="{{__('patients.index_title')}}" aria-label="آزمون‌ها">
            <span class="input-group-btn">
              <button type="submit" class="btn accent-color text-primary-color">{{__('patients.search')}}</button>
            </span>
          </div>
        </form>
      </div>
    </div>
    <br />
    @if(sizeof($patients))
      <table class="table table-striped">
        <thead>
          <tr>
            <th ><a href="{{route('patients.index',['search' => $search,'sort' => 'id'          ,'page' => $patients->currentPage()])}}">{{__('patients.row')}}</a></th>
            <th ><a href="{{route('patients.index',['search' => $search,'sort' => 'first_name'  ,'page' => $patients->currentPage()])}}">{{__('patients.first_name')}}</a></th>
            <th ><a href="{{route('patients.index',['search' => $search,'sort' => 'last_name'   ,'page' => $patients->currentPage()])}}">{{__('patients.last_name')}}</a></th>
            <th ><a href="{{route('patients.index',['search' => $search,'sort' => 'id_number'   ,'page' => $patients->currentPage()])}}">{{__('patients.id_number')}}</a></th>
            <th ><a href="{{route('patients.index',['search' => $search,'sort' => 'gender'      ,'page' => $patients->currentPage()])}}">{{__('patients.gender')}}</a></th>
            <th ><a href="{{route('patients.index',['search' => $search,'sort' => 'status'      ,'page' => $patients->currentPage()])}}">{{__('patients.status')}}</a></th>
            <th >{{__('patients.operation')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($patients as $patient)
            <tr>
            <td>{{$patient->id}}</td>
            <td><a href="{{route('patients.show', ['patient' => $patient])}}">{{$patient->fist_name}}</a></td>
            <td><a href="{{route('patients.show', ['patient' => $patient])}}">{{$patient->last_name}}</a></td>
            <td>{{$patient->id_number}}</td>
            <td>{{$patient->gender_str()}}</td>
            <td>{{$patient->status_str()}}</td>
            <td>
              <form action="{{route('patients.destroy', ['patient' => $patient])}}" style="display: inline" method="POST" class="trash-icon">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger">{{__('patients.remove')}}</button>
              </form>
              <a href="{{route('patients.edit', ['patient' => $patient])}}" class="btn btn-info" role="button">{{__('patients.edit')}}</a>
            </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <div class="row">
        <div class="col-md-12" style="text-align: center">
          {{__('patients.not_found')}}
        </div>
      </div>
    @endif
    </table>
  </div>
  <div class="row" style="text-align: center;">
    {{$patients->links()}}
  </div>
@endsection
