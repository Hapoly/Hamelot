<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use URL;
use App\Models\Transaction;
use App\User;
use App\Models\City;
use App\Models\Province;

use App\Http\Requests\Transaction\Create as TransactionCreateRequest;
use App\Http\Requests\Transaction\Edit as TransactionEditRequest;

class Transactions extends Controller{
  public function index(Request $request){
    $transactions = Transaction::fetch();
    $links = '';
    $sort = $request->input('sort', '###');
    
    if($request->has('sort'))
      $transactions = $transactions->orderBy($request->input('sort'), 'desc');
    $transactions = $transactions->paginate(10);
    
    return view('panel.transactions.index', [
      'transactions'   => $transactions,
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
  public function show(Request $request, Transaction $transaction){
    return view('panel.transactions.show', ['transaction' => $transaction]);
  }
  public function create(Request $request){
    return view('panel.transactions.create', [
      'provinces' => Province::all(),
      'cities'    => json_encode(City::all()),
    ]);
  }
  public function store(TransactionCreateRequest $request){
    $inputs = $request->all();
    if(!Auth::user()->isAdmin())
      $inputs['user_id'] = Auth::user()->id;
    else{
      $user = User::whereRaw("concat(first_name, ' ', last_name) = '". $request->full_name ."'")->first();
      if(!$user)
        return redirect()->route('panel.transactions.index');
        $inputs['user_id'] = $user->id;
    }
    $transaction = Transaction::create($inputs);
    return redirect()->route('panel.transactions.show', ['transaction' => $transaction]);
  }
  public function edit(Transaction $transaction){
    return view('panel.transactions.edit', [
      'transaction'   => $transaction,
      'provinces' => Province::all(),
      'cities'    => City::all(),
    ]);
  }
  public function update(TransactionEditRequest $request, Transaction $transaction){
    $inputs = $request->all();
    if(!Auth::user()->isAdmin())
      $inputs['user_id'] = Auth::user()->id;
    else{
      $user = User::whereRaw("concat(first_name, ' ', last_name) = '". $request->full_name ."'")->first();
      if(!$user)
        return redirect()->route('panel.transactions.index');
        $inputs['user_id'] = $user->id;
    }
    $transaction->fill($inputs)->save();
    return redirect()->route('panel.transactions.show', ['transaction' => $transaction]);
  }
  public function destroy(Transaction $transaction){
    $transaction->delete();
    if(URL::route('panel.transactions.show', ['transaction' => $transaction]) == URL::previous())
      return redirect()->route('panel.transactions.index');
    else
      return redirect()->back();
  }
}
