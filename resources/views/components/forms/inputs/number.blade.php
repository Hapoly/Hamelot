<?php
/**
 * inptus:
 *  $name, $value, $required, $label
 */
?>
<div class="col-md-{{isset($col)? $col : 12}}">

    <label for="{{$name}}" class="col-md-2 col-form-label text-center" style="float:right">{{$label}}</label>
    <div class="col-md-1" style="padding:0;">
        @if(isset($help))
            <div class="popup" id="popup{{$name}}"><i class="fa fa-question-circle" aria-hidden="true"></i>
                <span class="popuptext" id="help{{$name}}">
                    {{$help}}
                </span>
            </div>
        @endif
    </div>
    <div class="col-md-9" style="padding-left:0;">
        <input  id="{{$name}}" 
                type="number" 
                class="form-control {{ $errors->has($name) ? ' is-invalid' : '' }}" 
                name="{{$name}}" 
                value="{{$value}}"
                {{isset($required)? 'required': ''}}
                {{isset($max)? " max=$max": ''}}
                {{isset($min)? " min=$min": ''}}
                {{isset($placeholder)? " placeholder=$placeholder": ''}}
        />
        @if ($errors->has($name))
            <span class="invalid-feedback">
                <strong>{{ $errors->first($name) }}</strong>
            </span>
        @endif
    </div>
</div>
@if(isset($help))
    <script>
        // When the user clicks on div, open the popup
        $('#popup{{$name}}').on('click', function(){
            var popup = document.getElementById("help{{$name}}");
            popup.classList.toggle("show");
        });
    </script>
@endif