<div class="col-md-6">
    <div class="form-group">
        <select class="form-control" name="city_id" id="city_id" style="width: 100%">
            <option value="0">تمام شهرها</option>
            @foreach($cities as $city)
                <option value="{{$city->id}}" {{$city_id == $city->id ? 'selected': ''}}>{{$city->title}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <select class="form-control" name="province_id" id="province_id" style="width: 100%">
            <option value="0">تمام استان‌ها</option>
            @foreach($provinces as $province)
                <option value="{{$province->id}}" {{$province_id == $province->id ? 'selected': ''}}>{{$province->title}}</option>
            @endforeach
        </select>
    </div>
</div>
<script>
    $(document).ready(function(){
        let cities = {!! ($cities) !!};
        let provinces = {!! ($provinces) !!};
        $('#city_id').change(function(){
            for(let i=0; i<cities.length; i++){
                if(cities[i].id == $('#city_id').val())
                $('#province_id').val(cities[i].province_id);
            }
        })
        $('#province_id').change(function(){
            let hht = '<option value="0">تمام شهرهای استان</option>';
            for(let i=0; i<cities.length; i++){
                if(cities[i].province_id == $('#province_id').val())
                hht += '<option value="'+cities[i].id+'">'+cities[i].title+'</option>';
            }
            $('#city_id').html(hht);
        });
    })
</script>