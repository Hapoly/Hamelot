@extends('layouts.main')
@section('title', __('units.edit'))
@section('content')
<div class="container">
  @form_edit(['action' => route('panel.units.update', ['unit' => $unit]), 'title' => __('units.edit')])
    @input_text(['name' => 'title', 'value' => old('title', $unit->title), 'label' => __('units.title'), 'required' => true])
    <?php
        $parent_id_rows = [
          [
            'value'   => 0,
            'label'   => __('units.root_parent'),
          ]
        ];
        foreach($parents as $parent){
          array_push($parent_id_rows, [
            'value' => $parent->id,
            'label' => $parent->complete_title,
          ]);
        }
    ?>
    @input_select(['name' => 'parent_id', 'value' => old('parent_id', $unit->parent_id), 'label' => __('units.parent_id'), 'required' => true, 'rows' => $parent_id_rows])
    @input_text(['name' => 'address', 'value' => old('address', $unit->address), 'label' => __('units.address'), 'required' => true])
    @input_text(['name' => 'phone', 'value' => old('phone', $unit->phone), 'label' => __('units.phone'), 'required' => false])
    @input_text(['name' => 'mobile', 'value' => old('mobile', $unit->mobile), 'label' => __('units.mobile'), 'required' => false])
    @if(Auth::user()->isAdmin())
      <?php
          $status_rows = [
          [ 'value' => 1, 'label' => __('units.status_str.1') ],
          [ 'value' => 2, 'label' => __('units.status_str.2') ],
          ];
      ?>
      @input_select(['name' => 'status', 'value' => old('status', $unit->status), 'label' => __('units.status'), 'required' => true, 'rows' => $status_rows])
    @endif
    @input_image(['name' => 'image', 'label' => __('units.image'), 'required' => true])
    @input_city(['city_id' => old('city_id', $unit->city_id), 'lon' => old('lon', $unit->lon), 'lat' => old('lat', $unit->lat), 'province_id' => old('province_id', $unit->city->province_id)])
    <?php
        $status_rows = [
          [ 'value' => 1, 'label' => __('units.status_str.1') ],
          [ 'value' => 2, 'label' => __('units.status_str.2') ],
        ];
    ?>
    @input_select(['name' => 'status', 'value' => old('status', $unit->status), 'label' => __('units.status'), 'required' => true, 'rows' => $status_rows])
    <?php
        $group_code_rows = [
          [ 'value' => 1, 'label' => __('units.group_code_str.1') ],
          [ 'value' => 2, 'label' => __('units.group_code_str.2') ],
          [ 'value' => 3, 'label' => __('units.group_code_str.3') ],
          [ 'value' => 4, 'label' => __('units.group_code_str.4') ],
          [ 'value' => 5, 'label' => __('units.group_code_str.5') ],
        ];
    ?>
    @input_select(['name' => 'group_code', 'value' => old('group_code', $unit->group_code), 'label' => __('units.group_code'), 'required' => true, 'rows' => $group_code_rows])
    <?php
        $type_rows = [
          [ 'value' => 1, 'label' => __('units.type_str.1') ],
          [ 'value' => 2, 'label' => __('units.type_str.2') ],
        ];
    ?>
    @input_select(['name' => 'type', 'value' => old('type', $unit->type), 'label' => __('units.type'), 'required' => true, 'rows' => $type_rows])
    <?php
        $public_rows = [
          [ 'value' => 1, 'label' => __('units.public_str.1') ],
          [ 'value' => 2, 'label' => __('units.public_str.2') ],
        ];
    ?>
    @input_select(['name' => 'public', 'value' => old('public', $unit->public), 'label' => __('units.public'), 'required' => true, 'rows' => $public_rows])
    @submit_row(['value' => 'edit', 'label' => __('units.save')])
  @endform_create
</div>
@endsection