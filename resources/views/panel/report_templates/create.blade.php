@extends('layouts.main')
@section('title', 'قالب آزمایش جدید')
@section('content')
<div class="container">
  @form_create(['action' => route('panel.report_templates.store'), 'title' => 'قالب آزمایش جدید'])
    @input_text(['name' => 'title', 'label' => 'عنوان', 'placeholder' => 'عنوان آزمایش', 'value' => old('title', ''), 'row' => true])
    @input_text_area(['name' => 'description', 'label' => 'توضیحات', 'placeholder' => 'توضیحاتی مختصر درباره آزمایش', 'value' => old('description', ''), 'row' => true])
    @php
      $stats_rows = [
        ['label' => __('report_templates.status_str.' . 1), 'value' => 1],
        ['label' => __('report_templates.status_str.' . 2), 'value' => 2],
      ];
    @endphp
    @input_select(['name' => 'status', 'value' => old('status', ''), 'label' => 'وضعیت', 'required' => true, 'rows' => $stats_rows, 'row' => true])
    @multiautocomplete(['name' => 'fields', 'label' => 'فیلدها', 'value' => old('fields', ''), 'required' => true, 'route' => 'field_templates'])
    @submit_row(['value' => 'save', 'label' => 'ثبت'])
  @endform_edit
</div>
@endsection