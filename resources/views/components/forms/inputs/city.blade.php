<div class="form-group row create-form">
    <div class="col-md-10">
        <select class="form-control" name="province_id" id="province_id" style="width:93%">
            <option disabled selected value="0">{{__('units.please_choose')}}</option>
            @foreach($provinces as $province)
                <option value="{{$province->id}}">{{$province->title}}</option>
            @endforeach
        </select>
        @if ($errors->has('province_id'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('province_id') }}</strong>
            </span>
        @endif
    </div>
    <label for="province_id" class="col-md-2 col-form-label text-center">{{(__('units.province_id'))}}</label>
</div>
<div class="form-group row create-form">
    <div class="col-md-10">
        <select class="form-control" name="city_id" id="city_id" style="width:93%">
            <option disabled selected value="0">{{__('units.please_choose')}}</option>
        </select>
        @if ($errors->has('city_id'))
            <span class="invalid-feedback">
            <strong>{{ $errors->first('city_id') }}</strong>
            </span>
        @endif
    </div>
    <label for="city_id" class="col-md-2 col-form-label text-center">{{(__('units.city_id'))}}</label>
</div>
<div class="form-group row create-form">
    <div class="col-md-10">
    <input id="lon" type="text" class="form-control {{ $errors->has('lon') ? ' is-invalid' : '' }}" name="lon" required autofocus>
    @if ($errors->has('lon'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('lon') }}</strong>
        </span>
    @endif
    </div>
    <label for="lon" class="col-md-2 col-form-label text-center">{{__('units.lon')}}</label>
</div>
<div class="form-group row create-form">
    <div class="col-md-10">
    <input id="lat" type="text" class="form-control {{ $errors->has('lat') ? ' is-invalid' : '' }}" name="lat" required autofocus>
    @if ($errors->has('lat'))
        <span class="invalid-feedback">
        <strong>{{ $errors->first('lat') }}</strong>
        </span>
    @endif
    </div>
    <label for="lat" class="col-md-2 col-form-label text-center">{{__('units.lat')}}</label>
</div>
<script>
    $(document).ready(function(){
        const cities = {!! $cities !!};
        function updateCities(){
            console.log('test');
            let pid = $('#province_id').val();
            let cid_arr = '<option disabled selected>{{__('units.please_choose')}}</option>';
            for(let i=0; i<cities.length; i++)
                if(cities[i].province_id == pid)
                    cid_arr += ('<option value="'+cities[i].id+'">'+cities[i].title+'</option>');
            $('#city_id').html(cid_arr);
        }
        $('#province_id').change(function(){
            updateCities();
        });
        $('#city_id').change(function(){
            let cid = $('#city_id').val();
            for(let i=0; i<cities.length; i++){
                if(cities[i].id == cid){
                    $('#lon').val(cities[i].lon);
                    $('#lat').val(cities[i].lat);
                }
            }
        });
        $('#province_id').val({{$province_id}});
        updateCities();
        $('#city_id').val({{$city_id}});
        $('#lon').val({{$lon}});
        $('#lat').val({{$lat}});
    });
</script>