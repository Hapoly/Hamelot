<div class="form-group row create-form">
    <div class="col-md-4">
        <div class="col-md-10">
            <select class="form-control" name="{{$name}}year" id="{{$name}}year" style="width:93%">
                @for($i=1341; $i<1415; $i++)
                    <option value="{{$i}}" {{$year == $i ? 'selected': ''}}>{{$i}}</option>
                @endfor
            </select>
            @if ($errors->has($name . 'year'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first($name . 'year') }}</strong>
                </span>
            @endif
        </div>
        <label for="{{$name}}year" style="margin-top: 5px" class="col-md-2 col-form-label text-center">{{__('general.year')}}</label>
    </div>
    <div class="col-md-4">
        <div class="col-md-10">
            <select class="form-control" name="{{$name}}month" id="{{$name}}month" style="width:93%">
                @for($i=1; $i<13; $i++)
                    <option value="{{$i}}" {{$month == $i ? 'selected': ''}}>{{__('general.month_str.' . $i)}}</option>
                @endfor
            </select>
            @if ($errors->has($name . 'month'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first($name . 'month') }}</strong>
                </span>
            @endif
        </div>
        <label for="{{$name}}month" style="margin-top: 5px" class="col-md-2 col-form-label text-center">{{__('general.month')}}</label>
    </div>
    <div class="col-md-4">
        <div class="col-md-10">
            <select class="form-control" name="{{$name}}day" id="{{$name}}day" style="width:93%">
                @for($i=1; $i<32; $i++)
                    <option value="{{$i}}" {{$day == $i ? 'selected': ''}}>{{$i}}</option>
                @endfor
            </select>
            @if ($errors->has($name . 'day'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first($name . 'day') }}</strong>
                </span>
            @endif
        </div>
        <label for="{{$name}}day" style="margin-top: 5px" class="col-md-2 col-form-label text-center">{{__('general.day')}}</label>
    </div>
</div>