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
      @for($i=0; $i<sizeof(old('values', [])); $i++)
        <div class='col-md-12' id='range-{{$i+1}}' >
          <div class='panel panel-default create-card' style='margin-top:30px; background: #EEE; border-color: #EEE;' >
            <span class='closebtn' onclick='remove_range({{$i+1}})'>&times;</span>
            <div class='form-group row create-form'>
              <div class='col-md-12'>
                <div class='form-group test-in create-form' >
                  <div class='col-md-10'>
                    <input id='value' type='text' class='form-control' name='values[]' value="{{old('values.' . $i)}}" style='width:90%;'>
                    @if($errors->has('values.' . $i))
                      <span class="invalid-feedback">
                        <strong>مقدار مورد نیاز است</strong>
                      </span>
                    @endif
                  </div>
                  <label for='value' class='col-md-2 col-form-label text-center'>مقدار</label>
                </div>
              </div>
            </div>
            <div class='form-group row create-form'>
              <div class='col-md-12'>
                <div class='form-group test-in create-form' >
                  <div class='col-md-10'>
                    <input id='value' type='text' class='form-control' name='descriptions[]' value="{{old('descriptions.' . $i)}}" style='width:90%;'>
                    @if($errors->has('values.' . $i))
                      <span class="invalid-feedback">
                        <strong>باید توضیحاتی درباره توصیف ذکر شده وجود داشته باشد</strong>
                      </span>
                    @endif
                  </div>
                  <label for='value' class='col-md-2 col-form-label text-center'>مقدار</label>
                </div>
              </div>
            </div>
            <div class='form-group row create-form'>
              <div class='col-md-12'>
                <div class='form-group test-in'>
                  <div class='col-md-10' style='padding-right: 25px;'>
                    <select class='form-control' name='genders[]' style='width:88%; text-align:center'>
                      <option value='1' {{old('genders.' . $i) == 1? 'selected': ''}} >تمام جنسیت‌ها</option>
                      <option value='2' {{old('genders.' . $i) == 2? 'selected': ''}} >مذکر</option>
                      <option value='3' {{old('genders.' . $i) == 3? 'selected': ''}} >مونث</option>
                    </select>
                    @if($errors->has('genders.' . $i))
                      <span class="invalid-feedback">
                        <strong>جنسیت مورد نیاز است</strong>
                      </span>
                    @endif
                  </div>
                  <label for='type' class='col-md-2 col-form-label text-center'>جنسیت</label>
                </div>
              </div>
            </div>
            <div class='form-group row create-form'>
              <div class='col-md-12'>
                <div class='form-group test-in create-form' >
                  <div class='col-md-10'>
                    <input id='value' type='number' class='form-control' name='min_ages[]' placeholder='در صورت مهم نبودن صفر بگذارید' value='{{old('min_ages.' . $i)}}' style='width:90%;'>
                    @if($errors->has('min_ages.' . $i))
                      <span class="invalid-feedback">
                        <strong>حداقل سن موردنیاز است مشخص شود</strong>
                      </span>
                    @endif
                  </div>
                  <label for='value' class='col-md-2 col-form-label text-center'>حداقل سن</label>
                </div>
              </div>
            </div>
            <div class='form-group row create-form'>
              <div class='col-md-12'>
                <div class='form-group test-in create-form' >
                  <div class='col-md-10'>
                    <input id='value' type='number' class='form-control' name='max_ages[]' placeholder='در صورت مهم نبودن صفر بگذارید' value='{{old('max_ages.' . $i)}}' style='width:90%;'>
                    @if($errors->has('max_ages.' . $i))
                      <span class="invalid-feedback">
                        <strong>حداکثر سن موردنیازاست مشخص شود</strong>
                      </span>
                    @endif
                  </div>
                  <label for='value' class='col-md-2 col-form-label text-center'>حداکثر سن</label>
                </div>
              </div>
            </div>
            <div class='form-group row create-form'>
              <div class='col-md-12'>
                <div class='form-group test-in create-form' >
                  <div class='col-md-10'>
                    <input id='value' type='number' class='form-control' name='min_weights[]' placeholder='کلیوگرم، در صورت مهم نبودن صفر بگذارید' value='{{old('min_weights.' . $i)}}' style='width:90%;'>
                    @if($errors->has('min_weights.' . $i))
                      <span class="invalid-feedback">
                        <strong>حداقل وزن نیاز است که مشخص شود</strong>
                      </span>
                    @endif
                  </div>
                  <label for='value' class='col-md-2 col-form-label text-center'>حداقل وزن(کیلوگرم)</label>
                </div>
              </div>
            </div>
            <div class='form-group row create-form'>
              <div class='col-md-12'>
                <div class='form-group test-in create-form' >
                  <div class='col-md-10'>
                    <input id='value' type='number' class='form-control' name='max_weights[]' placeholder='کلیوگرم، در صورت مهم نبودن صفر بگذارید' value='{{old('max_weights.' . $i)}}' style='width:90%;'>
                    @if($errors->has('max_weights.' . $i))
                      <span class="invalid-feedback">
                        <strong>حداکثر وزن نیاز است که مشخص شود</strong>
                      </span>
                    @endif
                  </div>
                  <label for='value' class='col-md-2 col-form-label text-center'>حداکثر وزن(کیلوگرم</label>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endfor
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
var last_range_index = {{sizeof(old('values', [])) + 1}};
function remove_range(o){
    $("#range-" + o).remove();
}
function add_range(){
  last_range_index ++;
  $("#ranges").append(
      "<div class='col-md-12' id='range-"+last_range_index+"' >"+
      " <div class='panel panel-default create-card' style='margin-top:30px; background: #EEE; border-color: #EEE;' >"+
      "  <span class='closebtn' onclick='remove_range("+last_range_index+")'>&times;</span>"+
      "  <div class='form-group row create-form'>"+
      "    <div class='col-md-12'>"+
      "      <div class='form-group test-in create-form' >"+
      "        <div class='col-md-10'>"+
      "          <input id='value' type='text' class='form-control' name='values[]' style='width:90%;'>"+
      "        </div>"+
      "        <label for='value' class='col-md-2 col-form-label text-center'>مقدار</label>"+
      "      </div>"+
      "    </div>"+
      "  </div>"+
      "  <div class='form-group row create-form'>"+
      "    <div class='col-md-12'>"+
      "      <div class='form-group test-in create-form' >"+
      "        <div class='col-md-10'>"+
      "          <input id='value' type='text' class='form-control' name='descriptions[]' style='width:90%;'>"+
      "        </div>"+
      "        <label for='value' class='col-md-2 col-form-label text-center'>توضیحات</label>"+
      "      </div>"+
      "    </div>"+
      "  </div>"+
      "  <div class='form-group row create-form'>"+
      "    <div class='col-md-12'>"+
      "      <div class='form-group test-in'>"+
      "        <div class='col-md-10' style='padding-right: 25px;'>"+
      "          <select class='form-control' name='genders[]' style='width:88%; text-align:center'>"+
      "            <option value='1'>تمام جنسیت‌ها</option>"+
      "            <option value='2'>مذکر</option>"+
      "            <option value='3'>مونث</option>"+
      "          </select>"+
      "        </div>"+
      "        <label for='type' class='col-md-2 col-form-label text-center'>جنسیت</label>"+
      "      </div>"+
      "    </div>"+
      "  </div>"+
      "  <div class='form-group row create-form'>"+
      "   <div class='col-md-12'>"+
      "     <div class='form-group test-in create-form' >"+
      "       <div class='col-md-10'>"+
      "         <input id='value' type='number' class='form-control' name='min_ages[]' placeholder='در صورت مهم نبودن صفر بگذارید' style='width:90%;'>"+
      "       </div>"+
      "       <label for='value' class='col-md-2 col-form-label text-center'>حداقل سن</label>"+
      "     </div>"+
      "   </div>"+
      " </div>"+
      " <div class='form-group row create-form'>"+
      "   <div class='col-md-12'>"+
      "     <div class='form-group test-in create-form' >"+
      "       <div class='col-md-10'>"+
      "         <input id='value' type='number' class='form-control' name='max_ages[]' placeholder='در صورت مهم نبودن صفر بگذارید' style='width:90%;'>"+
      "       </div>"+
      "       <label for='value' class='col-md-2 col-form-label text-center'>حداکثر سن</label>"+
      "     </div>"+
      "   </div>"+
      " </div>"+
      " <div class='form-group row create-form'>"+
      "   <div class='col-md-12'>"+
      "     <div class='form-group test-in create-form' >"+
      "       <div class='col-md-10'>"+
      "         <input id='value' type='number' class='form-control' name='min_weights[]' placeholder='کلیوگرم، در صورت مهم نبودن صفر بگذارید' style='width:90%;'>"+
      "       </div>"+
      "       <label for='value' class='col-md-2 col-form-label text-center'>حداقل وزن(کیلوگرم)</label>"+
      "     </div>"+
      "   </div>"+
      " </div>"+
      " <div class='form-group row create-form'>"+
      "   <div class='col-md-12'>"+
      "     <div class='form-group test-in create-form' >"+
      "       <div class='col-md-10'>"+
      "         <input id='value' type='number' class='form-control' name='max_weights[]' placeholder='کلیوگرم، در صورت مهم نبودن صفر بگذارید' style='width:90%;'>"+
      "       </div>"+
      "       <label for='value' class='col-md-2 col-form-label text-center'>حداکثر وزن(کیلوگرم</label>"+
      "     </div>"+
      "   </div>"+
      " </div>"+
      "</div>"
  );
}
</script>
@endsection