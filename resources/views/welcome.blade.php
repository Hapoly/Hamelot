@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="search-things">
                <img src="/imgs/logo.png">
               <form>
                   <div class="form-group" style="padding-top:25px">
                       <input type="text" class="form-control search-input" style="width:80%;" placeholder="بیمارستان , درمانگاه , پزشک و...">
                   </div>
               </form>
               <div class="row">
                   <div class="col-md-6" style="text-align:left">
                        <button type="button" class="btn search-btns">
                            جستجو
                        </button>
                   </div>
                   <div class="col-md-6" style="text-align:right">
                        <button type="button" class="btn search-btns">
                            اطراف من !
                        </button>
                   </div>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection