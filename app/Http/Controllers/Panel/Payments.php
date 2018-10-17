<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

use App\Http\Requests\ZarinPal\CallBack as ZarinPalCallBackRequest;

use App\Models\Bid;
use App\Models\Demand;
use App\Models\Transaction;

use App\Drivers\SMS;
use App\Drivers\ZarinPal;

class Payments extends Controller{
    public function bidDepositVerify(ZarinPalCallBackRequest $request){
        $transaction = Transaction::where([
            'type'      => Transaction::BID_DEPOSIT_PAY,
            'authority' => $request->Authority,
        ])->firstOrFail();
        $bid = $transaction->bid;
        if(ZarinPal::verify($transaction->amount, $request->Authority)){
            $transaction->status = Transaction::PAID;
            $transaction->save();
            $bid->demand->acceptBid($bid);
            SMS::sendNewVisitMessage($bid);
        }
        return redirect()->route('panel.bids.show', ['bid' => $bid]);
    }
    public function bidRemainVerify(ZarinPalCallBackRequest $request, $finish){
        $transaction = Transaction::where([
            'type'      => Transaction::BID_REMAIN_PAY,
            'authority' => $request->Authority,
        ])->firstOrFail();
        $bid = $transaction->bid;
        if(ZarinPal::verify($transaction->amount, $request->Authority)){
            $transaction->status = Transaction::PAID;
            $transaction->save();
            if($finish == 'true')
                $bid->finish();
            else
                $bid->remain_paid();
            SMS::sendRemainPaidMessage($bid);
        }
        return redirect()->route('panel.bids.show', ['bid' => $bid]);
    }
}
