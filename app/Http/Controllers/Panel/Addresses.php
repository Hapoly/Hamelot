<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use URL;
use App\Models\Address;
use App\User;
use App\Models\City;
use App\Models\Province;

use App\Http\Requests\Address\Create as AddressCreateRequest;
use App\Http\Requests\Address\Edit as AddressEditRequest;

class Addresses extends Controller{
  public function index(Request $request){
    $addresses = Address::fetch();
    $links = '';
    $sort = $request->input('sort', '###');

    if($request->has('title'))
      $addresses = $addresses->whereRaw("title LIKE '%". $request->title ."%'");
    if($request->has('plain'))
      $addresses = $addresses->whereRaw("plain LIKE '%". $request->plain ."%'");
    if($request->has('full_name')){
      $user = User::getByName($request->full_name);
      $addresses = $addresses->where('user_id', $user->id);
    }
    if($request->has('province_id') && $request->province_id != 0){
      if($request->has('city_id') && $request->city_id != 0){
        $addresses = $addresses->where('city_id', $request->city_id);
      }else{
        $province_id = $request->province_id;
        $addresses = $addresses->whereHas('city', function($query) use ($province_id){
          return $query->where('province_id', $province_id);
        });
      }
    }else{
      if($request->has('city_id') && $request->city_id != 0){
        $addresses = $addresses->where('city_id', $request->city_id);
      }
    }
    
    if($request->has('sort'))
      $addresses = $addresses->orderBy($request->input('sort'), 'desc');
    $addresses = $addresses->paginate(10);
    
    return view('panel.addresses.index', [
      'addresses'   => $addresses,
      'links'       => $links,
      'sort'        => $sort,
      'search'      => isset(parse_url(url()->full())['query'])? parse_url(url()->full())['query']: '',
      'filters'     => [
        'title'       => $request->input('title', ''),
        'plain'       => $request->input('plain', ''),
        'province_id' => $request->input('province_id', ''),
        'city_id'     => $request->input('city_id', ''),
        'full_name'   => $request->input('full_name', ''),
      ],
      'provinces'   => Province::all(),
      'cities'      => City::all()
    ]);
  }
  public function show(Request $request, Address $address){
    return view('panel.addresses.show', ['address' => $address]);
  }
  public function create(Request $request){
    return view('panel.addresses.create', [
      'provinces' => Province::all(),
      'cities'    => json_encode(City::all()),
    ]);
  }
  public function store(AddressCreateRequest $request){
    $inputs = $request->all();
    if(!Auth::user()->isAdmin())
      $inputs['user_id'] = Auth::user()->id;
    else{
      $user = User::whereRaw("concat(first_name, ' ', last_name) = '". $request->full_name ."'")->first();
      if(!$user)
        return redirect()->route('panel.addresses.index');
        $inputs['user_id'] = $user->id;
    }
    $address = Address::create($inputs);
    return redirect()->route('panel.addresses.show', ['address' => $address]);
  }
  public function edit(Address $address){
    return view('panel.addresses.edit', [
      'address'   => $address,
      'provinces' => Province::all(),
      'cities'    => City::all(),
    ]);
  }
  public function update(AddressEditRequest $request, Address $address){
    $inputs = $request->all();
    if(!Auth::user()->isAdmin())
      $inputs['user_id'] = Auth::user()->id;
    else{
      $user = User::whereRaw("concat(first_name, ' ', last_name) = '". $request->full_name ."'")->first();
      if(!$user)
        return redirect()->route('panel.addresses.index');
        $inputs['user_id'] = $user->id;
    }
    $address->fill($inputs)->save();
    return redirect()->route('panel.addresses.show', ['address' => $address]);
  }
  public function destroy(Address $address){
    $address->delete();
    if(URL::route('panel.addresses.show', ['address' => $address]) == URL::previous())
      return redirect()->route('panel.addresses.index');
    else
      return redirect()->back();
  }
}
