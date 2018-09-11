<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Unit;

class Prints extends Controller{
  public function units(Request $request){
    $units = Unit::fetch($joined=$request->input('joined', false));
    $links = '';
    $sort = $request->input('sort', '###');
    
    if($request->has('root'))
      $units = $units->where('parent_id', 0);
    if($request->has('title'))
      $units = $units->whereRaw("title LIKE '%". $request->title ."%'");
    if($request->has('address'))
      $units = $units->whereRaw("address LIKE '%". $request->address ."%'");
    if($request->has('status') && $request->status != 0)
      $units = $units->where('status', $request->status);
    if($request->has('province_id') && $request->province_id != 0){
      if($request->has('city_id') && $request->city_id != 0){
        $units = $units->where('city_id', $request->city_id);
      }else{
        $province_id = $request->province_id;
        $units = $units->whereHas('city', function($query) use ($province_id){
          return $query->where('province_id', $province_id);
        });
      }
    }else{
      if($request->has('city_id') && $request->city_id != 0){
        $units = $units->where('city_id', $request->city_id);
      }
    }
    if($request->has('sort'))
      $units = $units->orderBy($request->input('sort'), 'desc');
    if($request->has('page')){
      if($request->page != 0)
        $units = $units->paginate(10);  
      else
        $units = $units->get();
    }else
      $units = $units->paginate(10);
    return view('panel.prints.units.index', [
      'units'  => $units,
    ]);
  }
  public function unitMembers(Unit $unit){
    return view('panel.prints.units.members', [
      'unit'  => $unit,
    ]);
  }
  public function unitInfo(Unit $unit){
    return view('panel.prints.units.info', [
      'unit'  => $unit,
    ]);
  }
  public function subUnits(Unit $unit){
    return view('panel.prints.units.sub_units', [
      'unit'  => $unit,
    ]);
  }
}
