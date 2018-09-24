@extends('layouts.main')
@section('title', __('demands.create'))
@section('content')
<?php
  use App\Models\Address;
?>
<div class="container">
  @form_create(['action' => route('panel.demands.store'), 'title' => __('demands.create')])
    @input_text(['name' => 'address', 'value' => old('address', ''), 'label' => __('demands.address'), 'required' => true])
    @input_text(['name' => 'phone', 'value' => old('phone', ''), 'label' => __('demands.phone'), 'required' => false])
    @input_text(['name' => 'mobile', 'value' => old('mobile', ''), 'label' => __('demands.mobile'), 'required' => false])
    @input_image(['name' => 'image', 'label' => __('demands.image'), 'required' => true])
    @input_city(['city_id' => old('city_id'), 'province_id' => old('province_id'), 'lon' => old('lon'), 'lat' => old('lat')])
    @if(Auth::user()->isAdmin())
      <?php
          $status_rows = [
            [ 'value' => 1, 'label' => __('demands.status_str.1') ],
            [ 'value' => 2, 'label' => __('demands.status_str.2') ],
          ];
      ?>
      @input_select(['name' => 'status', 'value' => old('status', ''), 'label' => __('demands.status'), 'required' => true, 'rows' => $status_rows])
    @endif
    <?php
      $addresses_rows = [];
      if(Auth::user()->isAdmin()){
        $addresses = Auth::user()->addresses;
        for($i=0; $i<sizeof($addresses); $i++){
          array_push($addresses_rows, [
            'value' => $addresses[$i]->id,
            'label' => $addresses[$i]->title . ' ('. $addresses[$i]->user->full_name .')'
          ]);
        }
      }else{
        $addresses = Address::all();
        for($i=0; $i<sizeof($addresses); $i++){
          array_push($addresses_rows, [
            'value' => $addresses[$i]->id,
            'label' => $addresses[$i]->title . ' ('. $addresses[$i]->user->full_name .')'
          ]);
        }
      }
    ?>
    @input_select(['name' => 'group_code', 'value' => old('group_code', ''), 'label' => __('demands.group_code'), 'required' => true, 'rows' => $group_code_rows])
    <?php
        $type_rows = [
          [ 'value' => 1, 'label' => __('demands.type_str.1') ],
          [ 'value' => 2, 'label' => __('demands.type_str.2') ],
        ];
    ?>
    @input_select(['name' => 'type', 'value' => old('type', ''), 'label' => __('demands.type'), 'required' => true, 'rows' => $type_rows])
    <?php
        $public_rows = [
          [ 'value' => 1, 'label' => __('demands.public_str.1') ],
          [ 'value' => 2, 'label' => __('demands.public_str.2') ],
        ];
    ?>
    @input_select(['name' => 'public', 'value' => old('public', ''), 'label' => __('demands.public'), 'required' => true, 'rows' => $public_rows])
    @submit_row(['value' => 'new', 'label' => __('demands.save')])
  @endform_create
</div>
@endsection