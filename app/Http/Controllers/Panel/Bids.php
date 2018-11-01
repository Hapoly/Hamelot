<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

use App\Http\Requests\Bid\Create as BidCreateRequest;
use App\Http\Requests\ZarinPal\CallBack as ZarinPalCallBackRequest;

use App\Models\Bid;
use App\Models\Demand;
use App\Models\Transaction;

use App\Drivers\ZarinPal;

class Bids extends Controller{
    public function index(Request $request){
        $bids = Bid::fetch();
        $links = '';
        $sort = $request->input('sort', '###');

        if($request->has('sort'))
            $bids = $bids->orderBy($request->input('sort'), 'desc');
        $bids = $bids->paginate(10);
        
        return view('panel.bids.index', [
            'bids'   => $bids,
            'links'       => $links,
            'sort'        => $sort,
            'search'      => isset(parse_url(url()->full())['query'])? parse_url(url()->full())['query']: '',
            'filters'     => [],
        ]);
    }
    public function create(Request $request){
        $demand = Demand::findOrFail($request->demand);
        return view('panel.bids.create', [
            'demand'    => $demand,
            'units'     => Auth::user()->units,
        ]);
    }
    public function store(BidCreateRequest $request){
        $inputs = $request->all();
        if($inputs['date'] > 9999999999)
            $inputs['date'] /= 1000;
        $target = explode('.', $inputs['target']);
        $inputs['unit_id'] = $target[0];
        $inputs['user_id'] = $target[1];
        $inputs['unit_accepted'] = 1;
        if($request->description == null)
            unset($inputs['description']);
        $bid = Bid::create($inputs);
        return redirect()->route('panel.bids.show', ['bid' => $bid]);
    }
    public function show(Request $request, Bid $bid){
        return view('panel.bids.show', ['bid' => $bid]);
    }

    public function inlineUpdate(Request $request, Bid $bid){
        switch($request->action){
            case 'accept':
                if(Auth::user()->isPatient()){
                    $authority = ZarinPal::generate(
                                                    $bid->deposit, 
                                                    $bid->unit->complete_title . ' - ' . $bid->user->full_name, 
                                                    route('panel.payments.bids.deposit.verify')
                                                );
                    Transaction::create([
                        'target'    => $bid->id,
                        'src_id'    => Auth::user()->id,
                        'dst_id'    => $bid->unit_id,
                        'comission' => $bid->unit->comission,
                        'amount'    => $bid->deposit,
                        'type'      => Transaction::BID_DEPOSIT_PAY,
                        'authority' => $authority,
                        'currency'  => 'tmn',
                        'pay_type'  => TRANSACTION::ONLINE_PAY,
                        'date'      => time(),
                    ]);
                    $pay_link = ZarinPal::generateLink($authority);
                    return redirect($pay_link);
                }else if(Auth::user()->isDoctor() || Auth::user()->isNurse()){
                    $bid->user_accepted = Bid::P_ACCEPTED;
                    $bid->save();
                    return redirect()->back();
                }
            case 'refuse':
                if(Auth::user()->isManager()){
                    $bid->unit_accepted = Bid::P_REFUSED;
                    $bid->status = Bid::UNIT_REFUSED;
                }else if(Auth::user()->isPatient()){
                    $bid->status = Bid::PATIENT_REFUSED;
                }else if(!Auth::user()->isAdmin()){
                    $bid->user_accepted = Bid::P_REFUSED;
                    $bid->status = Bid::UNIT_USER_REFUSED;
                }
                $bid->save();
                return redirect()->back();
            case 'cancel':
                if(Auth::user()->isManager() || Auth::user()->isDoctor() || Auth::user()->isNurse()){
                    Transaction::create([
                        'type'      => Transaction::BID_DEPOSIT_BACK,
                        'src_id'    => $bid->unit_id,
                        'comission' => $bid->unit->comission,
                        'dst_id'    => $bid->demand->patient_id,
                        'amount'    => $bid->deposit,
                        'status'    => Transaction::PAID,
                        'currency'  => 'tmn',
                        'pay_type'  => Transaction::ONLINE_PAY,
                        'target'    => $bid->id,
                        'authority' => 'NuLL',
                    ]);
                }
                $bid->status = Bid::CANCELED;
                $bid->save();
                return redirect()->back();
            case 'finish':
                if(Auth::user()->isManager() || Auth::user()->isDoctor() || Auth::user()->isNurse()){
                    $transaction = Transaction::where('target', $bid->id)->where('type', Transaction::BID_REMAIN_PAY)->firstOrFail();
                    $transaction->status = Transaction::PAID;
                    $transaction->save();
                    $bid->status = Bid::DONE;
                    $bid->save();
                    return redirect()->back();
                }else if(Auth::user()->isPatient()){
                    $transaction = Transaction::where('target', $bid->id)->where('type', Transaction::BID_REMAIN_PAY)->firstOrFail();
                    if($transaction->status == Transaction::PAID){
                        $bid->finish();
                        return redirect()->back();
                    }else{
                        $authority = ZarinPal::generate(
                            $bid->price - $bid->deposit, 
                            $bid->unit->complete_title . ' - ' . $bid->user->full_name, 
                            route('panel.payments.bids.remain.verify', ['finish' => 'true'])
                        );
                        $transaction->authority = $authority;
                        $transaction->pay_type = Transaction::ONLINE_PAY;
                        $transaction->save();
                        $pay_link = ZarinPal::generateLink($authority);
                        return redirect($pay_link);
                    }
                }
            case 'pay_remain':
                if(Auth::user()->isPatient()){
                    $transaction = Transaction::where('target', $bid->id)->where('type', Transaction::BID_REMAIN_PAY)->firstOrFail();
                    $authority = ZarinPal::generate(
                        $bid->price - $bid->deposit, 
                        $bid->unit->complete_title . ' - ' . $bid->user->full_name, 
                        route('panel.payments.bids.remain.verify', ['finish' => 'false'])
                    );
                    $transaction->authority = $authority;
                    $transaction->pay_type = Transaction::ONLINE_PAY;
                    $transaction->save();
                    $pay_link = ZarinPal::generateLink($authority);
                    return redirect($pay_link);
                }
        }
        return 'test';
    }
}
