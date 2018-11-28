@if(isset($row) && $row)
<div class="form-group row create-form">
@else
<div class="col-md-{{isset($col)? $col : 12}}">
@endif
    <label for="{{$name}}" class="col-md-2 label-col col-form-label text-center">{{ $label }}</label>
    <div class="col-md-10">
        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
            </div>
            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
            </div>
            <div>
                <span class="btn btn-default btn-file" style="display:block;margin:auto;"><span class="fileinput-new">انتخاب کنید</span><span class="fileinput-exists">تغییر</span><input id="profile" type="file" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}"></span>
            </div>
        </div>
        @if ($errors->has($name))
            <span class="invalid-feedback">
                <strong>{{ $errors->first($name) }}</strong>
            </span>
        @endif
    </div>
</div>