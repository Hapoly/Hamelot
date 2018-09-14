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
                    cache[ term ] = data;
                    response( data );
                });
            }
        });
    });
</script>

<div class="col-md-6">
    <div class="input-group">
        <span class="input-group-addon">{{$label}}</span>
        <input type="text" id="{{$name}}" class="form-control" value="{{$value}}" name="{{$name}}">
    </div>
</div>