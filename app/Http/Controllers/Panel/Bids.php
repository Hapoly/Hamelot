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

    public function inlineUpdate(Request $request, Bid $bid){
        switch($request->action){
            case 'accept':
                if(Auth::user()->isPatient()){
                    $authority = ZarinPal::generate(
                                                    $bid->deposit, 
                                                    $bid->unit->complete_title . ' - ' . $bid->user->full_name, 
                                                    route('panel.payments.bids.verify')
                                                );
                    Transaction::create([
                        'target'    => $bid->id,
                        'src_id'    => Auth::user()->id,
                        'dst_id'    => $bid->unit_id,
                        'amount'    => $bid->deposit,
                        'type'      => Transaction::BID_DEPOSIT_PAY,
                        'authority' => $authority,
                        'currency'  => 'tmn',
                        'pay_type'  => TRANSACTION::ONLINE_PAY,
                    ]);
                    $pay_link = ZarinPal::generateLink($authority);
                    return redirect($pay_link);
                }
            case 'refuse':
                if(Auth::user()->isManager()){
                    $bid->status = Bid::UNIT_REFUSED;
                }else if(Auth::user()->isPatient()){
                    $bid->status = Bid::PATIENT_REFUSED;
                }else if(!Auth::user()->isAdmin()){
                    $bid->status = Bid::UNIT_USER_REFUSED;
                }
                $bid->save();
                return redirect()->back();
        }
    }
}
