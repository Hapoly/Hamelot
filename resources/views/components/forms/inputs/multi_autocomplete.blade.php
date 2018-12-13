<?php
/**
 * inptus:
 *  $name, $value, $required, $label
 */
?>
<script>
    $( function() {
    function split( val ) {
        return val.split( /,\s*/ );
    }
    function extractLast( term ) {
        return split( term ).pop();
    }
    $( "#{{$name}}" )
        // don't navigate away from the field on tab when selecting an item
        .on( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        }).autocomplete({
            source: function( request, response ) {
                $.getJSON( "{{route('panel.search.' . $route)}}", {
                    term: extractLast( request.term )
                }, response );
            },
            search: function() {
                // custom minLength
                var term = extractLast( this.value );
                if ( term.length < 2 ) {
                return false;
                }
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },
            select: function( event, ui ) {
                var terms = split( this.value );
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push( ui.item.value );
                // add placeholder to get the comma-and-space at the end
                terms.push( "" );
                this.value = terms.join( ", " );
                return false;
            }
        });
    } );
</script>
<div class="form-group row create-form" id="{{$name}}-autocomplete">
    <div class="col-md-{{isset($col)? $col : 12}}" style="float: right">
        <div class="col-md-10">
            <input id="{{$name}}" type="text" class="form-control {{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}" value="{{$value}}" {{$required? 'required': ''}} placeholder="{{isset($placeholder)? $placeholder: ''}}">
            @if ($errors->has($name))
                <span class="invalid-feedback" id="{{$name}}-error-box">
                <strong>{{ $errors->first($name) }}</strong>
                </span>
            @endif
        </div>
        <label for="{{$name}}" class="col-md-2 col-form-label text-center">{{$label}}</label>
    </div>
</div>