<div class="form-group row create-form">
    <div class="col-md-10">
        <select class="form-control" name="{{$name}}" id="{{$name}}" style="width:93%">
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
    <label for="{{$name}}" class="col-md-2 col-form-label text-center">{{$label}}</label>
</div>