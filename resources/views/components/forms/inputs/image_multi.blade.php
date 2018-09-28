<div id="images-{{$name}}">
    <div class="form-group row create-form" id="image-0">
        <div class="col-md-10">
            <i class="fa fa-remove" style="position: absolute" onclick="remove_image(0)" aria-hidden="true"></i>
            <input id="{{$name}}[]" type="file" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}">
        </div>
        <div class="col-md-2">
            <label for="{{$name}}" class="col-md-2 col-form-label text-center">{{ $label }}</label>
        </div>
    </div>
</div>
<div class="form-group row create-form">
    <div class="col-md-10">
        <button id="add-image-{{$name}}" type="button" class="btn btn-default">{{__('general.add_image')}}</button>
    </div>
    <div class="col-md-2"></div>
</div>
<script>
    $(document).ready(function(){
        $('#add-image-{{$name}}').click(function(){
            $('#images').append(
                '<div class="form-group row create-form" id="image-0">'+
                    '<div class="col-md-10">'+
                        '<i class="fa fa-remove" style="position: absolute" onclick="remove_image(0)" aria-hidden="true"></i>'+
                        '<input id="{{$name}}[]" type="file" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}">'+
                    '</div>'+
                    '<div class="col-md-2">'+
                        '<label for="{{$name}}" class="col-md-2 col-form-label text-center">{{ $label }}</label>'+
                    '</div>'+
                '</div>'
            );        
        });
    });
</script>