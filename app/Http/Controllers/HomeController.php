<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Entry;
use App\Models\City;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home(){
        return view('home');
    }
    public function index(){
        $cities = City::has('units', '>', '0')->get();
        return view('welcome', [
            'cities'    => $cities,
        ]);
    }
    public function search(Request $request){
        $term = $request->input('term', '');
        $results = Entry::where('title', 'LIKE', "%$term%")->where('public', Entry::T_PUBLIC);
        if($request->input('city_id', '0') != '0')
            $results = $results->where('city_id', $request->city_id);
        if($request->has('group_code'))
            $results = $results->where('group_code', $request->group_code);
        $results = $results->paginate(10);
        return view('searched', [
            'results'   => $results,
            'term'      => $term,
        ]);
    }
}
