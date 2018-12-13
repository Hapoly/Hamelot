@extends('layouts.app')
@section('title', 'ثبت نام پزشک')
@section('content')
<div class="container">
    {{var_dump($errors->all())}}
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="login-card">
                <form class="login-form" method="POST" action="{{ route('store.doctor') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="msc" class="col-md-3 col-form-label text-md-right">{{ __('users.msc_doctor') }}</label>
                        <div class="col-md-8">
                            <input id="msc" type="text" class="form-control{{ $errors->has('msc') ? ' is-invalid' : '' }}" name="msc" value="{{ old('msc') }}" required>
                            @if ($errors->has('msc'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('msc') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="start_year" class="col-md-3 col-form-label text-md-right">{{ __('users.start_year_doctor') }}</label>
                        <div class="col-md-8">
                            <input id="start_year" type="number" min="1350" max="1400" class="form-control{{ $errors->has('start_year') ? ' is-invalid' : '' }}" name="start_year" value="{{ old('start_year') }}" required>
                            @if ($errors->has('start_year'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('start_year') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="gender" class="col-md-3 col-form-label text-md-right">{{ __('users.gender') }}</label>
                        <div class="col-md-8">
                            <select class="form-control" name="gender" id="gender">
                                <option value="1" {{old('gender') == 1? 'selected': ''}} > {{__('users.gender_str.1')}}</option>
                                <option value="2" {{old('gender') == 2? 'selected': ''}} > {{__('users.gender_str.2')}}</option>
                            </select>
                            @if ($errors->has('gender'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="profile" class="col-md-3 col-form-label text-md-right">{{ __('users.profile') }}</label>
                        <div class="col-md-8">
                            <input id="profile" type="file" class="form-control{{ $errors->has('profile') ? ' is-invalid' : '' }}" name="profile" >
                            @if ($errors->has('profile'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('profile') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="province_id" class="col-md-3 col-form-label text-md-right">{{(__('units.province_id'))}}</label>
                        <div class="col-md-8">
                            <select class="form-control" name="province_id" id="province_id">
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
                    </div>
                    <div class="form-group row">
                        <label for="city_id" class="col-md-3 col-form-label text-md-right">{{(__('units.city_id'))}}</label>
                        <div class="col-md-8">
                            <select class="form-control" name="city_id" id="city_id">
                                <option disabled selected value="0">{{__('units.please_choose')}}</option>
                                @foreach($provinces as $province)
                                    <option value="{{$province->id}}">{{$province->title}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('city_id'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('city_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lon" class="col-md-3 col-form-label text-md-right">{{ __('units.lon') }}</label>
                        <div class="col-md-8">
                            <input id="lon" type="text" class="form-control{{ $errors->has('lon') ? ' is-invalid' : '' }}" name="lon" value="{{ old('lon') }}" required>
                            @if ($errors->has('lon'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('lon') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lat" class="col-md-3 col-form-label text-md-right">{{ __('units.lat') }}</label>
                        <div class="col-md-8">
                            <input id="lat" type="text" class="form-control{{ $errors->has('lat') ? ' is-invalid' : '' }}" name="lat" value="{{ old('lat') }}" required>
                            @if ($errors->has('lat'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('lat') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-md-3 col-form-label text-md-right">{{ __('units.address') }}</label>
                        <div class="col-md-8">
                            <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" required>
                            @if ($errors->has('address'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="slug" class="col-md-3 col-form-label text-md-right">{{ __('units.slug') }}</label>
                        <div class="col-md-8">
                            <input id="slug" type="text" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" name="slug" value="{{ old('slug') }}" required>
                            @if ($errors->has('slug'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('slug') }}</strong>
                                </span>
                            @endif
                            <div class="popup" id="popupslug"><i class="fa fa-question-circle" aria-hidden="true"></i>
                                <span class="popuptext" id="helpslug">
                                    نام اختصاری مطب شما باید به انگلیسی باشد. این نام اختصاری در اصل در آدرس صفحه شخصی شما قرار می گیرد.
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-md-3 col-form-label text-md-right">{{ __('units.phone') }}</label>
                        <div class="col-md-8">
                            <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required>
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mobile" class="col-md-3 col-form-label text-md-right">{{ __('units.mobile') }}</label>
                        <div class="col-md-8">
                            <input id="mobile" type="text" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ old('mobile') }}" required>
                            @if ($errors->has('mobile'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('mobile') }}</strong>
                                </span>
                            @endif
                            <div class="popup" id="popupmobile"><i class="fa fa-question-circle" aria-hidden="true"></i>
                                <span class="popuptext" id="helpmobile">
                                    شماره موبایل منشی را وارد کنید. منشی شما میتواند با همین شماره موبایل وارد حساب کاربری خود شود
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row" id="field_names-autocomplete">
                        <label for="field_names" class="col-md-3 col-form-label text-md-right">{{__('users.fields')}}</label>
                        <div class="col-md-8 ui-widget">
                            <input id="field_names" type="text" class="form-control {{ $errors->has('field_names') ? ' is-invalid' : '' }}" name="field_names" value="{{old('field_names', '')}}">
                            <!-- <input hidden id="fields_id" name="fields_id" value="" /> -->
                            @if ($errors->has('fields_id'))
                                <span class="invalid-feedback" id="fields-error-box">
                                <strong>{{ $errors->first('fields_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-0" style="display: flex; justify-content: center;">
                        <button type="submit"class="btn btn-primary" style="margin: 10px">
                            {{ __('general.register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        const cities = {!! $cities !!};
        function updateCities(){
            let pid = $('#province_id').val();
            if(!pid)
                return;
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
        $('#province_id').val("{{old('province_id',0)}}");
        updateCities();
        $('#city_id').val("{{old('city_id')}}");
        $('#lon').val({{old('lon')}});
        $('#lat').val({{old('lat')}});

        // When the user clicks on div, open the popup
        $('#popupslug').on('click', function(){
            var popup = document.getElementById("helpslug");
            popup.classList.toggle("show");
        });
        $('#popupmobile').on('click', function(){
            var popup = document.getElementById("helpmobile");
            popup.classList.toggle("show");
        });

        $( function() {
            function split( val ) {
                return val.split( /,\s*/ );
            }
            function extractLast( term ) {
                return split( term ).pop();
            }

            $( "#field_names" )
            // don't navigate away from the field on tab when selecting an item
            .on( "keydown", function( event ) {
                if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
                    event.preventDefault();
                }
            }).autocomplete({
                source: function( request, response ) {
                    $.getJSON( "{{route('fields.doctor')}}", {
                        term: extractLast( request.term )
                    }, response );
                },
                search: function() {
                    // custom minLength
                    var term = extractLast( this.value );
                    if ( term.length < 2 ) {
                    return false;
                    }
                },
                focus: function() {
                    // prevent value inserted on focus
                    return false;
                },
                select: function( event, ui ) {
                    var terms = split( this.value );
                    // remove the current input
                    terms.pop();
                    // add the selected item
                    terms.push( ui.item.value );
                    // add placeholder to get the comma-and-space at the end
                    terms.push( "" );
                    this.value = terms.join( ", " );
                    return false;
                }
            });
        } );

    });
</script>
@endsection
