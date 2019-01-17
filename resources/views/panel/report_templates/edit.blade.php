@extends('layouts.main')
@section('title', 'ویرایش قالب')
@section('content')
<div class="container">
  @form_edit(['action' => route('panel.report_templates.update', ['report_template' => $report_template]), 'title' => 'ویرایش قالب ' . $report_template->title])
    @input_text(['name' => 'title', 'label' => 'عنوان', 'placeholder' => 'عنوان آزمایش', 'value' => old('title', $report_template->title), 'row' => true])
    @input_text_area(['name' => 'description', 'label' => 'توضیحات', 'placeholder' => 'توضیحاتی مختصر درباره آزمایش', 'value' => old('description', $report_template->description), 'row' => true])
    @php
      $stats_rows = [
        ['label' => __('report_templates.status_str.' . 1), 'value' => 1],
        ['label' => __('report_templates.status_str.' . 2), 'value' => 2],
      ];
    @endphp
    @input_select(['name' => 'status', 'value' => old('status', $report_template->status), 'label' => 'وضعیت', 'required' => true, 'rows' => $stats_rows, 'row' => true])
    @multiautocomplete(['name' => 'fields', 'label' => 'فیلدها', 'value' => old('fields', $report_template->fields_str), 'required' => true, 'route' => 'field_templates'])
    @submit_row(['value' => 'save', 'label' => 'ثبت'])
  @endform_edit
</div>
@endsection