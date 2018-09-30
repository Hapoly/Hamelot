<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Demand;
use App\Models\DemandAttachment;
use App\Models\Unit;
use App\Models\City;
use App\Models\Province;

use Auth;

use App\Http\Requests\Demand\CreateFree as DemandCreateFreeRequest;

class Demands extends Controller
{
    public function index(Request $request){
        $demands = Demand::fetch();
        $links = '';
        $sort = $request->input('sort', '###');

        if($request->has('unit_id') && $request->unit_id != 0)
        $demands = $demands->where('unit_id', $request->unit_id);
        if($request->has('status') && $request->status != 0)
        $demands = $demands->where('status', $request->status);
        if($request->has('province_id') && $request->province_id != 0){
            if($request->has('city_id') && $request->city_id != 0){
                $city_id = $request->city_id;
                $demands = $demands->whereHas('unit', function($query) use($city_id){
                    return $query->where('city_id', $city_id);
                });
            }else{
                $province_id = $request->province_id;
                $demands = $demands->whereHas('unit', function($query) use($province_id){
                    return $query->whereHas('city', function($query) use ($province_id){
                        return $query->where('province_id', $province_id);
                    });
                });
            }
        }else{
            if($request->has('city_id') && $request->city_id != 0){
                $city_id = $request->city_id;
                $demands = $demands->whereHas('unit', function($query) use($city_id){
                    return $query->where('city_id', $city_id);
                });
            }
        }
        if($request->has('sort'))
            $demands = $demands->orderBy($request->input('sort'), 'desc');
        $demands = $demands->paginate(10);
        
        return view('panel.demands.index', [
        'demands' => $demands,
        'units'       => Auth::user()->units,
        'cities'      => City::all(),
        'provinces'   => Province::all(),
        'links'       => $links,
        'sort'        => $sort,
        'search'      => isset(parse_url(url()->full())['query'])? parse_url(url()->full())['query']: '',
        'filters'     => [
            'unit_id'     => $request->input('unit_id', ''),
            'province_id' => $request->input('province_id', ''),
            'city_id'     => $request->input('city_id', ''),
            'status'      => $request->input('status'),
        ],
        ]);
    }
    public function createFree(Request $request){
        return view('panel.demands.create.free');
    }
    public function storeFree(DemandCreateFreeRequest $request){
        $inputs = $request->all();
        $inputs['start_time'] /= 10000;
        $inputs['end_time'] /= 10000;
        $inputs['patient_id'] = Auth::user()->id;
        $demand = Demand::create($inputs);
        if($request->hasFile('image')){
            $image = Storage::disk('public')->put('/demands', $request->file('image'));
            DemandAttachment::create([
                'demand_id' => $demand->id,
                'image'     => $image,
            ]);
        }
        return redirect()->route('panel.demands.show', ['demand' => $demand]);
    }
    public function edit(Request $request, Demand $demand){
        return view('panel.demands.edit', ['demand' => $demand]);
    }
    public function update(DemandEditRequest $request, Demand $demand){
        $inputs = $request->all();
        $inputs['start_time'] /= 10000;
        $inputs['end_time'] /= 10000;
        $demand = $demand->fill($inputs)->save();
        if($request->hasFile('image')){
            DemandAttachment::where('demand_id', $demand->id)->delete();
            $image = Storage::disk('public')->put('/demands', $request->file('image'));
            DemandAttachment::create([
                'demand_id' => $demand->id,
                'image'     => $image,
            ]);
        }
        return redirect()->route('panel.demands.show', ['demand' => $demand]);
    }
    public function show(Demand $demand){
        return view('panel.demands.show', ['demand' => $demand]);
    }
    public function destroy(Demand $demand){

    }
}
