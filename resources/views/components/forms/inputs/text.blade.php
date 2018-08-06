<?php
/**
 * inptus:
 *  $name, $value, $required, $label
 */
?>
<div class="form-group row create-form">
    <div class="col-md-10">
    <input id="{{$name}}" type="text" class="form-control {{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}" value="{{$value}}" {{$required? 'required': ''}} autofocus>
    @if ($errors->has($name))
        <span class="invalid-feedback">
        <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
    </div>
    <label for="{{$name}}" class="col-md-2 col-form-label text-center">{{$label}}</label>
</div>