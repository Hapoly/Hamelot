<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Demand;

class Demands extends Controller
{
    public function index(Request $request){
        $experiments = Demand::fetch();
        $links = '';
        $sort = $request->input('sort', '###');

        if($request->has('unit_id') && $request->unit_id != 0)
        $experiments = $experiments->where('unit_id', $request->unit_id);
        if($request->has('status') && $request->status != 0)
        $experiments = $experiments->where('status', $request->status);
        if($request->has('province_id') && $request->province_id != 0){
        if($request->has('city_id') && $request->city_id != 0){
            $city_id = $request->city_id;
            $experiments = $experiments->whereHas('unit', function($query) use($city_id){
            return $query->where('city_id', $city_id);
            });
        }else{
            $province_id = $request->province_id;
            $experiments = $experiments->whereHas('unit', function($query) use($province_id){
            return $query->whereHas('city', function($query) use ($province_id){
                return $query->where('province_id', $province_id);
            });
            });
        }
        }else{
        if($request->has('city_id') && $request->city_id != 0){
            $city_id = $request->city_id;
            $experiments = $experiments->whereHas('unit', function($query) use($city_id){
            return $query->where('city_id', $city_id);
            });
        }
        }
        if($request->has('sort'))
        $experiments = $experiments->orderBy($request->input('sort'), 'desc');
        $experiments = $experiments->paginate(10);
        
        return view('panel.experiments.index', [
        'experiments' => $experiments,
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
    public function create(Request $request){

    }
    public function store(DemandCreateRequest $request){

    }
    public function edit(Request $request, Demand $demand){

    }
    public function update(DemandEditRequest $request, Demand $demand){

    }
    public function show(Demand $demand){

    }
    public function destroy(Demand $demand){

    }
}
