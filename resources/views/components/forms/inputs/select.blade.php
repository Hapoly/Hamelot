@if(isset($row) && $row)
<div class="form-group row create-form">
@else
<div class="col-md-{{isset($col)? $col : 12}}">
<<<<<<< HEAD
@endif
    @if(isset($help))
        <div class="popup" id="popup{{$name}}"><i class="fa fa-question-circle" aria-hidden="true"></i>
            <span class="popuptext" id="help{{$name}}">
                {{$help}}
            </span>
        </div>
    @endif
    <label for="{{$name}}" class="col-md-{{isset($col)?3:2}} col-form-label text-center" style="float:right">{{$label}}</label>
    <div class="col-md-{{isset($col)?9:10}}">
        <select class="form-control" name="{{$name}}" id="{{$name}}" style="width:{{isset($col)?87:93}}%" {{isset($disabled)? ($disabled? 'disabled': ''): ''}}>
=======
   
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
        <select class="form-control" name="{{$name}}" id="{{$name}}" style="width:93%" {{isset($disabled)? ($disabled? 'disabled': ''): ''}}>
>>>>>>> cf95b2530346da5c1ecc6ad6d1acf9ad67a61936
            @foreach($rows as $row)
                <option value="{{$row['value']}}" {{$value == $row['value'] ? 'selected': ''}}>{{$row['label']}}</option>
            @endforeach
        </select>
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