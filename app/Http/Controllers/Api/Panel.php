<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital;
use URL;

class Panel extends Controller{
    public function units(Request $request){
        $hospital = Hospital::find($request->hospital_id);
        if(!$hospital) return [];
        return $hospital->units;
    }
}