<?php
/**
 * inptus:
 *  $name, $value, $required, $label
 */
?>
<div class="form-group row create-form">
    <div class="col-md-10">
        <input style="width: auto; float: right" id="{{$id}}" type="radio" name="{{$name}}" value="{{$value}}" {{$checked? 'checked': ''}}> 
        <label style="width: auto; float: right; margin-right: 15px;">{{$label}}</label>
        @if ($errors->has($name))
            <span class="invalid-feedback">
            <strong>{{ $errors->first($name) }}</strong>
            </span>
        @endif
    </div>
    <div class="col-md-2"></div>
</div>