<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

use App\Http\Requests\ZarinPal\CallBack as ZarinPalCallBackRequest;

use App\Models\Bid;
use App\Models\Demand;
use App\Models\Transaction;

use App\Drivers\ZarinPal;

class Payments extends Controller{
    public function bidVerify(ZarinPalCallBackRequest $request){
        
        $transaction = Transaction::where([
            'type'      => Transaction::BID_DEPOSIT_PAY,
            'authority' => $request->Authority,
        ])->firstOrFail();
        $bid = $transaction->bid;
        if(ZarinPal::verify($transaction->amount, $request->Authority)){
            $transaction->status = Transaction::PAID;
            $transaction->save();
            $bid->demand->acceptBid($bid);
        }
        return redirect()->route('panel.demands.show', ['demand' => $bid->demand]);
    }
}
