<?php
/**
 * inptus:
 *  $name, $value, $required, $label
 */
?>
<div class="form-group row create-form">
    <div class="col-md-10">
        <div class="input-group" style="width: 93%">
            <input type="number" min="0" class="input-group-with-left-addon" name="{{$name}}" value="{{$value}}">
            <span class="left-addon">{{$placeholder}}</span>  
        </div>
    </div>
    <label for="{{$name}}" class="col-md-2 col-form-label text-center">{{$label}}</label>
</div>