<?php
/**
 * inptus:
 *  $name, $value, $required, $label
 */
?>
<div class="form-group row create-form">
    <div class="col-md-{{isset($col)? $col : 12}}">
        <div class="col-md-10">
            <input type="text" id="{{$name}}-v" value="{{$value!=''?\App\Drivers\Time::jdate('Y/m/d H:i', $value):''}}" class="form-control {{ $errors->has($name) ? ' is-invalid' : '' }}"/>
            <input hidden type="number" name="{{$name}}" id="{{$name}}" value="{{$value}}"/>
            @if ($errors->has($name))
                <span class="invalid-feedback">
                <strong>{{ $errors->first($name) }}</strong>
                </span>
            @endif
        </div>
        <label for="{{$name}}" class="col-md-2 col-form-label text-center">{{$label}}</label>
    </div>
</div>
<script>
    $("#{{$name}}-v").pDatepicker({
        'altField'          : '#{{$name}}',
        'format'            : 'YY/MM/DD HH:MM',
        'onlySelectOnDate'  : true,
        'initialValue'      : false,
    });
</script>