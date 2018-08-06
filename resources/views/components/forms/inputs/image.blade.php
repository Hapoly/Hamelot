<div class="form-group row create-form">
    <div class="col-md-10">
    <input id="{{$name}}" type="file" class="form-control{{ $errors->has($name) ? ' is-invalid' : '' }}" name="{{$name}}">
    @if ($errors->has($name))
        <span class="invalid-feedback">
        <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
    </div>
    <label for="{{$name}}" class="col-md-2 col-form-label text-center">{{ $label }}</label>
</div>