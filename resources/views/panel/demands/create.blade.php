@extends('layouts.main')
@section('title', __('demands.create'))
@section('content')
<?php
  use App\Models\Address;
?>
<div class="container">
  @form_create(['action' => route('panel.demands.store'), 'title' => __('demands.create')])
    @input_text(['name' => 'description', 'value' => old('description', ''), 'label' => __('demands.description'), 'required' => true])
    <?php
      $address_rows = [];
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
    @input_select(['name' => 'address', 'value' => old('address', ''), 'label' => __('demands.address'), 'required' => true, 'rows' => $address_rows])
    <?php
      $address_rows = [];
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
    @input_select(['name' => 'address', 'value' => old('address', ''), 'label' => __('demands.address'), 'required' => true, 'rows' => $address_rows])
    @submit_row(['value' => 'new', 'label' => __('demands.save')])
  @endform_create
</div>
@endsection