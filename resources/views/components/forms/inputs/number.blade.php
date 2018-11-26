<?php
/**
 * inptus:
 *  $name, $value, $required, $label
 */
?>
<div class="form-group row create-form">
    <div class="col-md-{{isset($col)? $col : 12}}">
        <label for="{{$name}}" class="col-md-2 col-form-label text-center" style="float:right">{{$label}}</label>
        <div class="col-md-10">
        <input  id="{{$name}}" 
                type="number" 
                class="form-control {{ $errors->has($name) ? ' is-invalid' : '' }}" 
                name="{{$name}}" 
                value="{{$value}}"
                {{isset($required)? 'required': ''}}
                {{isset($max)? " max=$max": ''}}
                {{isset($min)? " min=$min": ''}}
                {{isset($placeholder)? " placeholder=$placeholder": ''}}
        >
        @if ($errors->has($name))
            <span class="invalid-feedback">
            <strong>{{ $errors->first($name) }}</strong>
            </span>
        @endif
        </div>
       
    </div>
</div>