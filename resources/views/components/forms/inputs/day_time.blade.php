@php
    $hour = intval(($value % (24 * 3600)) / 3600);
    $minute = intval(($value % (24 * 3600)) / 60) %60;
@endphp
@if(isset($row) && $row)
<div class="form-group row create-form">
@else
<div class="col-md-{{isset($col)? $col : 12}}" style="float: right">
@endif
    <div class="row" style="margin: 0px 0px !important;">
        <div class="col-md-12 text-center" style="padding-top:5px;padding-bottom:20px;">
            {{$label}}
            @if(isset($help))
                <div class="col-md-1" style="padding:0;">
                    <div class="popup" id="popup{{$name}}"><i class="fa fa-question-circle" aria-hidden="true"></i>
                    <span class="popuptext" id="help{{$name}}">
                        {{$help}}
                    </span>
                    </div>
                </div>
            @endif
        </div>
    </div>
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
            />
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
            />
            @if ($errors->has($name . 'hour'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first($name.'hour') }}</strong>
                </span>
            @endif
        </div>
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

