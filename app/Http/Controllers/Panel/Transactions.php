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
use App\Models\Unit;
use App\Models\City;
use App\Models\Province;
use App\Models\BankAccount;
use App\Models\UnitUser;

use App\Drivers\ZarinPal;

use App\Http\Requests\Transaction\CreateFree as TransactionCreateFreeRequest;
use App\Http\Requests\Transaction\EditFree as TransactionEditFreeRequest;

use App\Http\Requests\Transaction\CreateWithdraw as TransactionCreateWithdrawRequest;
use App\Http\Requests\Transaction\EditWithdraw as TransactionEditWithdrawRequest;

class Transactions extends Controller{
  public function index(Request $request){
    $transactions = Transaction::fetch();
    $links = '';
    $sort = $request->input('sort', '###');
    
    if($request->input('min_amount', 0) > 0)
      $transactions = $transactions->where('amount', '>', $request->min_amount);
    if($request->input('max_amount', 0) > 0)
      $transactions = $transactions->where('amount', '<', $request->max_amount);

    if($request->input('min_date', 0) > 0)
      $transactions = $transactions->where('date', '>', $request->min_date/1000);
    if($request->input('max_date', 0) > 0)
      $transactions = $transactions->where('date', '<', $request->max_date/1000);

    if($request->input('type', 0) > 0)
      $transactions = $transactions->where('type', $request->type);
    if($request->input('pay_type', 0) > 0)
      $transactions = $transactions->where('pay_type', $request->pay_type);
    if($request->input('status', 0) > 0)
      $transactions = $transactions->where('status', $request->status);

    if($request->has('sort'))
      $transactions = $transactions->orderBy($request->input('sort'), 'desc');
    $transactions = $transactions->paginate(10);
    
    return view('panel.transactions.index', [
      'transactions'  => $transactions,
      'links'         => $links,
      'sort'          => $sort,
      'search'        => isset(parse_url(url()->full())['query'])? parse_url(url()->full())['query']: '',
      'filters'       => [
        'min_date'        => $request->input('min_date', 0)/1000,
        'max_date'        => $request->input('max_date', 0)/1000,
        'min_amount'      => $request->input('min_amount', ''),
        'max_amount'      => $request->input('max_amount', ''),
        'pay_type'        => $request->input('pay_type', ''),
        'status'          => $request->input('status', ''),
        'type'            => $request->input('type', ''),
      ],
      'provinces'   => Province::all(),
      'cities'      => City::all()
    ]);
  }
  public function show(Request $request, Transaction $transaction){
    return view('panel.transactions.show', ['transaction' => $transaction]);
  }
  public function createFree(Request $request){
    return view('panel.transactions.create.free');
  }
  public function createWithdraw(Request $request){
    return view('panel.transactions.create.withdraw', [
      'bank_accounts' => BankAccount::fetch()->get(),
    ]);
  }
  public function storeFree(TransactionCreateFreeRequest $request){
    $inputs = $request->all();
    $data = [
      'src_id'    => '0',
      'date'      => $request->date/1000,
      'amount'    => $request->amount,
      'type'      => Transaction::FREE,
      'pay_type'  => Transaction::ONLINE_PAY,
      'authority' => 'NuLL',
      'currency'  => 'tmn',
      'status'    => Transaction::PAID,
      'target'    => 'NuLL',
    ];
    if($request->target_type == 1){ // user
      $data['dst_id'] = $request->user_id;
    }else{ // unit id
      $data['dst_id'] = $request->unit_id;
      $data['comission'] = 0;
    }
    $transaction = Transaction::create($data);
    return redirect()->route('panel.transactions.show', ['transaction' => $transaction]);
  }
  public function storeWithdraw(TransactionCreateWithdrawRequest $request){
    $bank_account = BankAccount::find($request->bank_account_id);
    $data = [
      'src_id'    => '0',
      'dst_id'    => $bank_account->unit->id,
      'comission' => $bank_account->unit->comission,
      'date'      => $request->date,
      'amount'    => $request->amount,
      'type'      => Transaction::WITHDRAW,
      'pay_type'  => Transaction::ONLINE_PAY,
      'authority' => 'NuLL',
      'currency'  => 'tmn',
      'status'    => Transaction::PENDING,
      'target'    => $bank_account->id,
    ];
    if(Auth::user()->isAdmin())
      $data['status'] = $request->input('status', 1);
    $data['comission'] = $bank_account->unit->comission;
    $transaction = Transaction::create($data);
    return redirect()->route('panel.transactions.show', ['transaction' => $transaction]);
  }
  public function editFree(Transaction $transaction){
    if(!$transaction->can_modify)
      abort(403);
    return view('panel.transactions.edit.free', ['transaction' => $transaction]);
  }
  public function editWithdraw(Transaction $transaction){
    if(!$transaction->can_modify)
      abort(403);
    return view('panel.transactions.edit.withdraw', [
      'transaction' => $transaction,
      'bank_accounts' => BankAccount::fetch()->get(),
    ]);
  }
  public function updateFree(TransactionEditFreeRequest $request, Transaction $transaction){
    if(!$transaction->can_modify)
      abort(403);
    $transaction->amount = $request->amount;
    $transaction->date = $request->date;
    if($request->target_type == 1)
      $transaction->dst_id = $request->user_id;
    else if($request->target_type == 2)
      $transaction->dst_id = $request->unit_id;
    $transaction->save();
    return redirect()->route('panel.transactions.show', ['transaction' => $transaction]);
  }
  public function updateWithdraw(TransactionEditWithdrawRequest $request, Transaction $transaction){
    if(!$transaction->can_modify)
      abort(403);
    $bank_account = BankAccount::find($request->bank_account_id);
    $transaction->amount = $request->amount;
    $transaction->date = $request->date;
    $transaction->target = $bank_account->id;
    $transaction->dst_id = $bank_account->unit_id;
    if(Auth::user()->isAdmin())
      $transaction->status = $request->input('status', 1);
    $transaction->save();
    return redirect()->route('panel.transactions.show', ['transaction' => $transaction]);
  }
  public function destroy(Transaction $transaction){
    if(!$transaction->can_delete)
      abort(401);
    $transaction->delete();
    if(URL::route('panel.transactions.show', ['transaction' => $transaction]) == URL::previous())
      return redirect()->route('panel.transactions.index');
    else
      return redirect()->back();
  }

  /**
   * pay off actions for unit managers to say we paid for users
   */
  public function payList(Request $request){
    $unit_users = UnitUser::whereHas('unit', function($query){
      return $query->whereHas('managers', function($query){
        return $query->where('users.id', Auth::user()->id);
      });
    })->where('status', UnitUser::ACCEPTED)->where('permission', UnitUser::MEMBER);
    $links = '';
    $sort = $request->input('sort', '###');
    if($request->has('unit_id') && $request->unit_id != "0"){
      $unit_users = $unit_users->where('unit_id', $request->unit_id);
    }
    if($request->has('user_id')){
      $user = User::getByName($request->user_id);
      if($user){
        $unit_users = $unit_users->where('user_id', $user->id);
      }
    }
    if($request->has('sort'))
      $unit_users = $unit_users->orderBy($request->input('sort'), 'desc');
    $unit_users = $unit_users->paginate(10);
    return view('panel.transactions.pay_off.index', [
      'unit_users'  => $unit_users,
      'units'       => Unit::fetch(true)->get(),
      'links'       => $links,
      'sort'        => $sort,
      'search'          => isset(parse_url(url()->full())['query'])? parse_url(url()->full())['query']: '',
      'filters'         => [
        'unit_id'           => $request->input('unit_id', "0"),
        'user_id'           => $request->input('user_id', ""),
        'status'            => $request->input('status',  "0"),
      ],
    ]);
  }
  public function paid(Request $request, UnitUser $unit_user){
    Transaction::create([
      'src_id'    => $unit_user->unit_id,
      'dst_id'    => $unit_user->user_id,
      'amount'    => $unit_user->dept,
      'pay_type'  => Transaction::ONLINE_PAY,
      'target'    => '0',
      'authority' => 'NuLL',
      'status'    => Transaction::PAID,
      'comission' => 0,
      'currency'  => 'tmn',
      'type'      => Transaction::USER_WITHDRAW,
      'date'      => time(),
    ]);
    return redirect()->back();
  }

  public function facturesLive(Request $request, Unit $unit){
    $transactions = Transaction::whereHas('dst_unit', function($query) use($unit){
      return $query->where('units.id', $unit->id);
    })->where('pay_type', Transaction::OFFLINE_PAY)->where('status', Transaction::PAID)->get();
    return view('panel.transactions.factures.live', [
      'transactions'  => $transactions,
      'unit'          => $unit,
    ]);
  }

  public function facturesIndex(Request $request){
    $units = Auth::user()->units;
    return view('panel.transactions.factures.index', [
      'units' => $units,
    ]);
  }

  public function facturesPay(Request $request, Unit $unit){
    $authority = ZarinPal::generate(
        $unit->facture_amount, 
        'صورتحساب ' . $unit->title,
        route('panel.payments.factures.verify')
    );
    Transaction::create([
      'type'      => Transaction::FACTURE,
      'amount'    => $unit->facture_amount,
      'src_id'    => $unit->id,
      'dst_id'    => '0',
      'target'    => '0',
      'authority' => $authority,
      'currency'  => 'tmn',
      'comission' => 0,
      'pay_type'  => Transaction::ONLINE_PAY,
      'date'      => time(),
    ]);
    $pay_link = ZarinPal::generateLink($authority);
    return redirect($pay_link);
  }
}
