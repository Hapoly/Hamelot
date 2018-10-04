<?php
/**
 * inptus:
 *  $name, $value, $required, $label
 */
?>
<script>
    $( function() {
        var cache = {};
        $( "#{{$name}}" ).autocomplete({
            minLength: 2,
            source: function( request, response ) {
                var term = request.term;
                if ( term in cache ) {
                    response( cache[ term ] );
                    return;
                }
                $.getJSON( "{{route('panel.search.' . $route)}}", request, function( data, status, xhr ) {
                    console.log(data);
                    cache[ term ] = data;
                    response( data );
                });
            }
        });
    });
    $(document).ready(function(){
        function update_id(){
            var data = new FormData();
            let term = $("#{{$name}}").val().split(' - ')[0];
            
            if(term  == '')
                return;
            var xhr = new XMLHttpRequest();
            xhr.withCredentials = true;

            xhr.addEventListener("readystatechange", function () {
                if (this.readyState === this.DONE) {
                    let result = JSON.parse(this.responseText);
                    if(result.length){
                        $("#{{$name}}").val(result[0].value)
                        $('#{{$name}}-autocomplete').removeClass('has-error');
                        $("#{{$name}}_id").val(result[0].id);
                    }else{
                        $('#{{$name}}-autocomplete').addClass('has-error');
                    }
                }
            });
            xhr.open("GET", "{{route('panel.search.' . $route)}}?term=" + term);
            xhr.send(data);
        }
        update_id();
        $("#{{$name}}").change(function(){
            update_id();
        });
        $("#{{$name}}").focusout(function(){
            update_id();
        });
    });
</script>
<div class="form-group row create-form" id="{{$name}}-autocomplete">
    <div class="col-md-10">
        <input id="{{$name}}" type="text" class="form-control {{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}" value="{{$value}}" {{$required? 'required': ''}} placeholder="{{isset($placeholder)? $placeholder: ''}}">
        <input hidden id="{{$name}}_id" name="{{$name}}_id" value="" />
        @if ($errors->has($name))
            <span class="invalid-feedback" id="{{$name}}-error-box">
            <strong>{{ $errors->first($name) }}</strong>
            </span>
        @endif
    </div>
    <label for="{{$name}}" class="col-md-2 col-form-label text-center">{{$label}}</label>
</div>