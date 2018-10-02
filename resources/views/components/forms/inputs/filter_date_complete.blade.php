<?php
/**
 * inptus:
 *  $name, $value, $required, $label
 */
?>
<div class="input-group">
    <span class="input-group-addon">{{$label}}</span>
    <input type="text" id="{{$name}}-v" value="{{$value!=''?\App\Drivers\Time::jdate('Y/m/d H:i', $value):''}}" class="form-control"/>
    <input hidden type="number" name="{{$name}}" id="{{$name}}" value="{{$value}}"/>
</div>
<script>
    $("#{{$name}}-v").pDatepicker({
        'altField'          : '#{{$name}}',
        'format'            : 'YYYY/MM/DD HH:MM',
        'onlySelectOnDate'  : true,
        'initialValue'      : false,
    });
</script>