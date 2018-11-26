<?php
/**
 * inptus:
 *  $name, $value, $label
 */
?>
@php
    $hour = intval(($value % (24 * 3600)) / 3600);
    $minute = intval(($value % (24 * 3600)) / 60) %60;
@endphp

<div class="col-md-{{isset($col)? $col : 12}}">
    <div class="">
        <div class="col-md-12 text-center">
            {{$label}}
        </div>
    </div>
    <div class="form-group row create-form">
        <div >
            
            <div class="col-md-6">
            <label for="{{$name}}" class="col-md-4 col-form-label text-center" style="float:right">دقیقه</label>
                <div class="col-md-8">
                    <input  id="{{$name}}" 
                            type="number" 
                            class="form-control {{ $errors->has($name) ? ' is-invalid' : '' }}" 
                            name="{{$name}}minute" 
                            value="{{$minute}}"
                            {{isset($required)? 'required': ''}}
                            {{isset($max)? " max=$max": ''}}
                            {{isset($min)? " min=$min": ''}}
                            {{isset($placeholder)? " placeholder=$placeholder": ''}}
                    >
                    @if ($errors->has($name . 'minute'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first($name.'minute') }}</strong>
                        </span>
                    @endif
                </div>
            
            </div>
            <div class="col-md-6">
                <label for="{{$name}}" class="col-md-4 col-form-label text-center" style="float:right">ساعت</label>
                <div class="col-md-8">
                    <input  id="{{$name}}" 
                            type="number" 
                            class="form-control {{ $errors->has($name) ? ' is-invalid' : '' }}" 
                            name="{{$name}}hour" 
                            value="{{$hour}}"
                            {{isset($required)? 'required': ''}}
                            {{isset($max)? " max=$max": ''}}
                            {{isset($min)? " min=$min": ''}}
                            {{isset($placeholder)? " placeholder=$placeholder": ''}}
                    >
                    @if ($errors->has($name . 'hour'))
                        <span class="invalid-feedback">
                        <strong>{{ $errors->first($name.'hour') }}</strong>
                        </span>
                    @endif
                </div>
                
            </div>
        </div>
    </div>
</div>

