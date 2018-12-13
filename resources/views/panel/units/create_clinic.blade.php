@extends('layouts.main')
@section('title', __('units.create_clinic'))
@section('content')
<div class="container">
  @form_create(['action' => route('panel.units.store'), 'title' => __('units.create_clinic')])
    @input_text(['name' => 'title', 'value' => old('title', ''), 'label' => __('units.title'), 'required' => true, 'row' => true])
    @input_text(['name' => 'slug', 'value' => old('slug', ''), 'label' => __('units.slug'), 'required' => true, 'row' => true])
    <input hidden name="parent_id" value="0" />
    @input_text(['name' => 'address', 'value' => old('address', ''), 'label' => __('units.address'), 'required' => true, 'row' => true])
    @input_text(['name' => 'phone', 'value' => old('phone', ''), 'label' => __('units.phone'), 'required' => false, 'row' => true])
    @input_text(['name' => 'mobile', 'value' => old('mobile', ''), 'label' => __('units.mobile'), 'required' => false, 'row' => true])
    @input_image(['name' => 'image', 'label' => __('units.image'), 'required' => true, 'row' => true])
    @input_city(['city_id' => old('city_id'), 'province_id' => old('province_id'), 'lon' => old('lon'), 'lat' => old('lat'), 'row' => true])
    @if(Auth::user()->isAdmin())
      <?php
          $status_rows = [
            [ 'value' => 1, 'label' => __('units.status_str.1') ],
            [ 'value' => 2, 'label' => __('units.status_str.2') ],
          ];
      ?>
      @input_select(['name' => 'status', 'value' => old('status', ''), 'label' => __('units.status'), 'required' => true, 'rows' => $status_rows, 'row' => true])
    @else
      <input name="status" value="1" hidden />
    @endif
    <input name="group_code" value="4" hidden />
    <?php
        $type_rows = [
          [ 'value' => 1, 'label' => __('units.type_str.1') ],
          [ 'value' => 2, 'label' => __('units.type_str.2') ],
        ];
    ?>
    @input_select(['name' => 'type', 'value' => old('type', ''), 'label' => __('units.type'), 'required' => true, 'rows' => $type_rows, 'row' => true])
    <?php
        $public_rows = [
          [ 'value' => 1, 'label' => __('units.public_str.1') ],
          [ 'value' => 2, 'label' => __('units.public_str.2') ],
        ];
    ?>
    @input_select(['name' => 'public', 'value' => old('public', ''), 'label' => __('units.public'), 'required' => true, 'rows' => $public_rows, 'row' => true])
    @submit_row(['value' => 'new', 'label' => __('units.save')])
  @endform_create
</div>
@endsection
