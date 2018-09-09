<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Hospital;

class Prints extends Controller{
  public function hospitals(Request $request){
    $hospitals = Hospital::fetch($joined=$request->input('joined', false));
    $links = '';
    $sort = $request->input('sort', '###');

    if($request->has('title'))
      $hospitals = $hospitals->whereRaw("title LIKE '%". $request->title ."%'");
    if($request->has('address'))
      $hospitals = $hospitals->whereRaw("address LIKE '%". $request->address ."%'");
    if($request->has('status') && $request->status != 0)
      $hospitals = $hospitals->where('status', $request->status);
    if($request->has('province_id') && $request->province_id != 0){
      if($request->has('city_id') && $request->city_id != 0){
        $hospitals = $hospitals->where('city_id', $request->city_id);
      }else{
        $province_id = $request->province_id;
        $hospitals = $hospitals->whereHas('city', function($query) use ($province_id){
          return $query->where('province_id', $province_id);
        });
      }
    }else{
      if($request->has('city_id') && $request->city_id != 0){
        $hospitals = $hospitals->where('city_id', $request->city_id);
      }
    }
    if($request->has('sort'))
      $hospitals = $hospitals->orderBy($request->input('sort'), 'desc');
    if($request->has('page')){
      if($request->page != 0)
        $hospitals = $hospitals->paginate(10);  
      else
        $hospitals = $hospitals->get();
    }else
      $hospitals = $hospitals->paginate(10);
    return view('panel.prints.hospitals', [
      'hospitals'  => $hospitals,
    ]);
  }
}
