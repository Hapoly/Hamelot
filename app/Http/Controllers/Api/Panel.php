<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Unit;
use URL;

class Panel extends Controller{
    public function units(Request $request){
        $unit = Unit::find($request->unit_id);
        if(!$unit) return [];
        return $unit->units;
    }
}