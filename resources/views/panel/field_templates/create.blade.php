@extends('layouts.main')
@section('title', 'فیلد جدید')
@section('content')
<div class="container">
  @form_create(['action' => route('panel.field_templates.store'), 'title' => 'فیلد جدید', 'row' => true])
    @input_text(['name' => 'title', 'value' => old('title', ''), 'label' => 'عنوان', 'required' => true, 'row' => true])
    @input_text(['name' => 'unit', 'value' => old('unit', ''), 'label' => 'واحد', 'required' => true, 'row' => true])
    @input_text_area(['name' => 'description', 'value' => old('description', ''), 'label' => 'توضیحات', 'required' => true, 'row' => true])
    @php
      $type_rows = [];
      foreach(__('field_templates.type_str') as $key=>$value)
        array_push($type_rows, [
          'label' => $value,
          'value' => $key,
        ]);
      
      $status_rows = [];
      foreach(__('field_templates.status_str') as $key=>$value)
        array_push($status_rows, [
          'label' => $value,
          'value' => $key,
        ]);
    @endphp
    @input_select(['name' => 'type', 'value' => old('type', ''), 'label' => 'نوع', 'required' => true, 'rows' => $type_rows, 'row' => true])
    @input_select(['name' => 'status', 'value' => old('status', ''), 'label' => 'وضعیت', 'required' => true, 'rows' => $status_rows, 'row' => true])
    <div id="ranges" class="form-row">

    </div>
    <div class="form-group row mb-0">
        <div class="col-md-12">
            <button type="button" onclick="add_range()" class="btn accent-color text-primary-color new-meet" style="margin-top: 10px;">توصیف جدید</button>
            @submit_row(['value' => 'save', 'label' => 'ذخیره'])
        </div>
    </div>
  @endform_create
</div>
<script>
function setOnChange(){
    $(".type").unbind( "change" );
    $(".type").change(function(e){
        let typeId = e.target.id
        let labelId = $("#" + typeId).attr('data-label');
        switch($("#"+typeId).val()){
            case "1":
            case "3":
                $("#" + labelId).prop('disabled', false);
                break;
            case "4":
            case "2":
                $("#" + labelId).prop('disabled', true);
                break;
        }
    })

}
setOnChange();
var last_range_index = {{sizeof(old('titles', [])) + 1}};
function remove_range(o){
    $("#range-" + o).remove();
}
function add_range(){
  last_range_index ++;
  $("#ranges").append(
      "<div class='col-md-12' id='range-"+last_range_index+"' >"+
      " <div class='panel panel-default create-card' style='margin-top:30px; background: #EEE; border-color: #EEE;' >"+
      "  <span class='closebtn' onclick='remove_range("+last_range_index+")'>&times;</span>"+ 
      "  <div class='row'>"+
      "    <div class='col-md-12'>"+
      "      <div class='form-group test-in create-form' >"+
      "        <div class='col-md-10'>"+
      "          <input id='value' type='text' class='form-control' name='values[]' style='width:90%;'>"+
      "        </div>"+
      "        <label for='value' class='col-md-2 col-form-label text-center'>مقدار</label>"+
      "      </div>"+
      "    </div>"+
      "    <div class='form-group row create-form'>"+
      "      <div class='col-md-12'>"+
      "        <div class='form-group test-in'>"+
      "          <div class='col-md-10'>"+
      "            <select class='form-control type' id='type-"+last_range_index+"' data-label='quantity-"+last_range_index+"' style='width:90%;text-align:center'>"+
      "              <option value='1'>{{__('reports.type_str.1')}}</option>"+
      "              <option value='2'>{{__('reports.type_str.2')}}</option>"+
      "              <option value='3'>{{__('reports.type_str.3')}}</option>"+
      "              <option value='4'>{{__('reports.type_str.4')}}</option>"+
      "              <option value='5'>{{__('reports.type_str.5')}}</option>"+
      "            </select>"+
      "          </div>"+
      "          <label for='type' class='col-md-2 col-form-label text-center'>{{__('reports.type')}}</label>"+
      "        </div>"+
      "      </div>"+
      "    </div>"+
      "    <div class='col-md-12'>"+
      "      <div class='form-group test-in create-form' >"+
      "        <div class='col-md-10'>"+
      "          <input type='text' class='form-control' name='labels[]' style='width:90%;'>"+
      "        </div>"+
      "        <label  class='col-md-2 col-form-label text-center'>{{__('reports.label')}}</label>"+
      "      </div>"+
      "    </div>"+
      "    <div class='col-md-12'>"+
      "      <div class='form-group test-in create-form' >"+
      "        <div class='col-md-10'>"+
      "          <input id='quantity-"+last_range_index+"' type='text' class='form-control' name='quantities[]' style='width:90%;'>"+
      "        </div>"+
      "        <label for='quantity-"+last_range_index+"' class='col-md-2 col-form-label text-center'>{{__('reports.quantity')}}</label>"+
      "      </div>"+
      "    </div>"+
      "    <div class='form-group create-form'>"+
      "      <div class='col-md-12'>"+
      "        <div class='form-group test-in'>"+
      "          <div class='col-md-10'>"+
      "            <div class='form-group'>"+
      "              <textarea class='form-control' rows='3' id='descriptions' name='descriptions[]' style='width:90%'></textarea>"+
      "            </div>"+
      "          </div>"+
      "          <label for='status' class='col-md-2 col-form-label text-center'>{{__('reports.description')}}</label>"+
      "        </div>"+
      "      </div>"+
      "    </div>"+
      "  </div>"+
      " </div>"+
      "</div>"
  );
  setOnChange();
}
</script>
@endsection