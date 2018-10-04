<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use URL;
use App\User;

use App\Models\BankAccount;
use App\Http\Requests\BankAccount\Create as BankAccountCreateRequest;
use App\Http\Requests\BankAccount\Edit as BankAccountEditRequest;
class BankAccounts extends Controller{
  public function index(Request $request){
    $bank_accounts = BankAccount::fetch();
    $links = '';
    $sort = $request->input('sort', '###');
    $bank_accounts = $bank_accounts->paginate(10);
    
    return view('panel.bank_accounts.index', [
      'bank_accounts'   => $bank_accounts,
      'links'       => $links,
      'sort'        => $sort,
      'search'      => isset(parse_url(url()->full())['query'])? parse_url(url()->full())['query']: '',
      'filters'     => [
      ],
    ]);
  }
  public function show(Request $request, BankAccount $bank_account){
    return view('panel.bank_accounts.show', ['bank_account' => $bank_account]);
  }
  public function create(Request $request){
    return view('panel.bank_accounts.create');
  }
  public function store(BankAccountCreateRequest $request){
    $inputs = $request->all();
    $bank_account = BankAccount::create($inputs);
    return redirect()->route('panel.bank-accounts.show', ['bank_account' => $bank_account]);
  }
  public function edit(BankAccount $bank_account){
    return view('panel.bank_accounts.edit', [
      'bank_account'   => $bank_account,
    ]);
  }
  public function update(BankAccountEditRequest $request, BankAccount $bank_account){
    $inputs = $request->all();
    $bank_account->fill($inputs)->save();
    return redirect()->route('panel.bank-accounts.show', ['bank_account' => $bank_account]);
  }
  public function destroy(BankAccount $bank_account){
    $bank_account->delete();
    if(URL::route('panel.bank-accounts.show', ['bank_account' => $bank_account]) == URL::previous())
      return redirect()->route('panel.bank-accounts.index');
    else
      return redirect()->back();
  }
}
