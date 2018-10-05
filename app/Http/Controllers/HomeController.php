<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Entry;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function search(Request $request){
        $term = $request->input('term', '');
        $results = Entry::where('title', 'LIKE', "%$term%");
        $results = $results->paginate(10);
        return view('searched', [
            'results'   => $results,
            'term'      => $term,
        ]);
    }
}
