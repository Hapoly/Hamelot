@extends('layouts.main')
@section('title', __('demands.edit_title'))
@section('content')
<?php
  use App\Models\Address;
?>
<div class="container">
  @form_create(['action' => route('panel.demands.update', ['demand' => $demand]), 'title' => __('demands.edit_title')])
    @csrf
    <div class="col-md-10">
      @if($demand->user_id != '0' || $demand->unit_id != '0')
        <style>
          th, td{
            text-align: center;
          }
          table {
            margin: 15px 10px;
            width: 90%;
          }
          th, tr, td {
            border-style: solid;
            border-width: 1px;
          }
        </style>
        <table>
          <tbody>
            @if($demand->user_id != '0')
              <tr>
                <th>{{__('demands.user_id')}}</th>
                <td>{{$demand->user->full_name}}</td>
              </tr>
            @endif
            @if($demand->unit_id != '0')
              <tr>
                <th>{{__('demands.unit_id')}}</th>
                <td>{{$demand->unit->complete_title}}</td>
              </tr>
            @endif
          </tbody>
        </table>
      @endif
    </div>
    <div class="col-md-2"></div>
    @input_text(['name' => 'description', 'value' => old('description', $demand->description_str), 'label' => __('demands.description'), 'required' => true])
    @php
      $address_rows = [
        [
          'value' => 0,
          'label' => __('demands.no_address'),
        ]
      ];
      if(Auth::user()->isAdmin()){
        $addresses = Address::all();
        for($i=0; $i<sizeof($addresses); $i++){
          array_push($address_rows, [
            'value' => $addresses[$i]->id,
            'label' => $addresses[$i]->title . ' ('. $addresses[$i]->user->full_name .')'
          ]);
        }
      }else{
        $addresses = Auth::user()->addresses;
        for($i=0; $i<sizeof($addresses); $i++){
          array_push($address_rows, [
            'value' => $addresses[$i]->id,
            'label' => $addresses[$i]->title
          ]);
        }
      }
    @endphp
    @input_select(['name' => 'address_id', 'value' => old('address_id', $demand->address_id), 'label' => __('demands.address_id'), 'required' => true, 'rows' => $address_rows])
    @php
      $asap_rows = [
        ['value' => 0,'label' => __('demands.asap_str.0')],
        ['value' => 1,'label' => __('demands.asap_str.1')],
      ];
    @endphp
    @input_select(['name' => 'asap', 'value' => old('asap', $demand->asap), 'label' => __('demands.asap'), 'required' => true, 'rows' => $asap_rows])
    @input_date_complete(['name' => 'start_time', 'label' => __('demands.start_time'), 'value'  => old('start_time', $demand->start_time)])
    @input_date_complete(['name' => 'end_time', 'label' => __('demands.end_time'), 'value'  => old('end_time', $demand->end_time)])
    @input_image(['name' => 'image', 'label' => __('demands.image')])
    <script>
      $(document).ready(function(){
        $('#asap').change(function(){
          let v = $('#asap').val();
          if(v == 0){
            $('#start_time-v').attr('disabled', false)
            $('#end_time-v').attr('disabled', false)
          }else{
            $('#start_time-v').attr('disabled', true)
            $('#end_time-v').attr('disabled', true)
          }
        })
        let v = $('#asap').val();
        if(v == 0){
          $('#start_time-v').attr('disabled', false)
          $('#end_time-v').attr('disabled', false)
        }else{
          $('#start_time-v').attr('disabled', true)
          $('#end_time-v').attr('disabled', true)
        }
      })
    </script>
    @submit_row(['value' => 'new', 'label' => __('demands.save')])
  @endform_create
</div>
@endsection