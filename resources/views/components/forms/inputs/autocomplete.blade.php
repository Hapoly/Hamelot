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
                $.getJSON( "{{route('panel.search.patients')}}", request, function( data, status, xhr ) {
                    cache[ term ] = data;
                    response( data );
                });
            }
        });
    });
</script>
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