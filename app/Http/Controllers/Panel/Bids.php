<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

use App\Http\Requests\Bid\Create as BidCreateRequest;

use App\Models\Bid;
use App\Models\Demand;

class Bids extends Controller{
    public function create(Request $request){
        $demand = Demand::findOrFail($request->demand);
        return view('panel.bids.create', [
            'demand'    => $demand,
            'units'     => Auth::user()->units,
        ]);
    }
    public function store(BidCreateRequest $request){
        $inputs = $request->all();
        $target = explode('.', $inputs['target']);
        $inputs['unit_id'] = $target[0];
        $inputs['user_id'] = $target[1];
        if($request->description == null)
            unset($inputs['description']);
        $bid = Bid::create($inputs);
        return redirect()->route('panel.bids.show', ['bid' => $bid]);
    }
    public function show(Request $request, Bid $bid){
        return view('panel.bids.show', ['bid' => $bid]);
    }
}
