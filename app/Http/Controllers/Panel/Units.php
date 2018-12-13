<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use URL;
use App\Models\Unit;
use App\Models\UnitUser;
use App\Models\Province;
use App\Models\City;
use App\User;
use App\Http\Requests\Unit\Create as UnitCreateRequest;
use App\Http\Requests\Unit\Edit as UnitEditRequest;

class Units extends Controller{
  public function index(Request $request){
    $units = Unit::fetch($request->input('joined', false));
    $links = '';
    $sort = $request->input('sort', '###');

    if($request->has('root'))
      $units =$units->where('parent_id', 0);
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
    $units = $units->paginate(10);
    
    return view('panel.units.index', [
      'units'       => $units,
      'links'       => $links,
      'sort'        => $sort,
      'search'      => isset(parse_url(url()->full())['query'])? parse_url(url()->full())['query']: '',
      'filters'     => [
        'title'       => $request->input('title', ''),
        'address'     => $request->input('address', ''),
        'province_id' => $request->input('province_id', ''),
        'city_id'     => $request->input('city_id', ''),
        'status'      => $request->input('status'),
        'root'        => $request->has('root'),
        'joined'      => $request->has('joined'),
      ],
      'provinces'   => Province::all(),
      'cities'      => City::all()
    ]);
  }
  public function show(Request $request, Unit $unit){
    return view('panel.units.show', ['unit' => $unit]);
  }
  public function create(Request $request){
    $parents = new Unit;
    if(Auth::user()->isAdmin())
      $parents = $parents->all();
    else
      $parents = Unit::whereHas('managers', function($query){
        return $query->where('users.id', Auth::user()->id);
      })->get();
    return view('panel.units.create', [
      'provinces' => Province::all(),
      'cities'    => json_encode(City::all()),
      'parents'   => $parents,
      'parent_id' => $request->input('unit_id', 0),
    ]);
  }
  /**
   * 
   */
  private function replace_digits($str){
    $digit_translates = [
        '۰' => '0',
        '۱' => '1',
        '۲' => '2',
        '۳' => '3',
        '۴' => '4',
        '۵' => '5',
        '۶' => '6',
        '۷' => '7',
        '۸' => '8',
        '۹' => '9',
    ];
    foreach($digit_translates as $persian=>$latina){
        $str = str_replace($persian, $latina, $str);
    }
    return $str;
  }
  public function store(UnitCreateRequest $request){
    $inputs = $request->all();
    if($request->hasFile('image'))
      $inputs['image'] = Storage::disk('public')->put('/units', $request->file('image'));
    $inputs['phone'] = $this->replace_digits($inputs['phone']);
    $inputs['mobile'] = $this->replace_digits($inputs['mobile']);
    $unit = Unit::create($inputs);

    $secretary = User::where('phone', $inputs['mobile'])->first();
    if(!$secretary)
      $secretary = User::create([
        'phone' => $inputs['mobile'],
        'group_code'  => User::G_SECREATRY
      ]);
    UnitUser::create([
      'user_id' => $secretary->id,
      'unit_id' => $unit->id,
      'permission'  => UnitUser::SECRETARY,
      'status'  => UnitUser::ACCEPTED,
    ]);
    
    if(!Auth::user()->isAdmin()){
      UnitUser::create([
        'unit_id' => $unit->id,
        'user_id' => Auth::user()->id,
        'status'  => UnitUser::ACCEPTED,
        'permission' => UnitUser::MANAGER,
      ]);
      UnitUser::create([
        'unit_id' => $unit->id,
        'user_id' => Auth::user()->id,
        'status'  => UnitUser::ACCEPTED,
        'permission' => UnitUser::MEMBER,
      ]);
    }
    return redirect()->route('panel.units.show', ['unit' => $unit]);
  }
  public function edit(Unit $unit){
    $parents = Unit::whereHas('managers', function($query){
      return $query->where('users.id', Auth::user()->id);
    });
    return view('panel.units.edit', [
      'unit'      => $unit,
      'provinces' => Province::all(),
      'cities'    => City::all(),
      'parents'   => $parents,
    ]);
  }
  public function update(UnitEditRequest $request, Unit $unit){
    $inputs = $request->all();
    if($request->hasFile('image'))
      $inputs['image'] = Storage::disk('public')->put('/units', $request->file('image'));
    $unit->fill($inputs)->save();
    return redirect()->route('panel.units.show', ['unit' => $unit]);
  }
  public function destroy(Unit $unit){
    $unit->delete();
    if(URL::route('panel.units.show', ['unit' => $unit]) == URL::previous())
      return redirect()->route('panel.units.index');
    else
      return redirect()->back();
  }

  public function createClinic(Request $request){
    return view('panel.units.create_clinic', [
      'provinces' => Province::all(),
      'cities'    => json_encode(City::all()),
    ]);
  }
}
