<?php
/**
 * inptus:
 *  $name, $value, $required, $label
 */
?>
<div class="form-group row create-form">
    <div class="col-md-{{isset($col)? $col : 12}}">
        @if(isset($help))
            <div class="popup" id="popup{{$name}}"><i class="fa fa-question-circle" aria-hidden="true"></i>
                <span class="popuptext" id="help{{$name}}">
                    {{$help}}
                </span>
            </div>
        @endif
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
