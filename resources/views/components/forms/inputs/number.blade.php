@if(isset($row) && $row)
<div class="form-group row create-form">
@else
<div class="col-md-{{isset($col)? $col : 12}}" style="float: right">
@endif
    <label for="{{$name}}" class="col-md-{{isset($col)?3:2}} col-form-label text-center" style="float:right">{{$label}}</label>
    <div class="col-md-{{isset($col)?9:10}}" style="padding-left:0;">
        <input  id="{{$name}}" 
                type="number"
                style="{{isset($col)?'width: 84%': 'width: 91%'}}"
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
        @if(isset($help))
            <div class="popup" id="popup{{$name}}"><i class="fa fa-question-circle" aria-hidden="true"></i>
                <span class="popuptext" id="help{{$name}}">
                    {{$help}}
                </span>
            </div>
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