<?php
namespace App\Drivers;
use Kavenegar\KavenegarApi;
use Kavenegar\Exceptions\ApiException;
use Kavenegar\Exceptions\HttpException;
use App\Models\Bid;
/**
 * Kavenegar library
 * this library handles sms
 * 
 * @author  mr-exception
 * @license GNU/LGPL
 * @version 1.0.0
 */
class SMS {
    public static function sendNewVisitMessage(Bid $bid){
        if($bid->deposit == 0){
            $user_message = SMS::getMessage($bid, 'visit.new.free_deposit.user');
            $patient_message = SMS::getMessage($bid, 'visit.new.free_deposit.patient');
        }else{
            $user_message = SMS::getMessage($bid, 'visit.new.paid_deposit.user');
            $patient_message = SMS::getMessage($bid, 'visit.new.paid_deposit.patient');
        }
        try{
            $api = new KavenegarApi(env('KAVENEGAR_API_TOKEN'));
            $api->Send('', $bid->user->phone, $user_message);
            $api->Send('', $bid->demand->patient->phone, $patient_message);
        }
        catch(ApiException $e){
            echo $e->errorMessage();
        }
        catch(HttpException $e){
            echo $e->errorMessage();
        }
    }

    public static function sendRemainPaidMessage(Bid $bid){
        $user_message = SMS::getMessage($bid, 'visit.paid_remain.user');
        $patient_message = SMS::getMessage($bid, 'visit.paid_remain.patient');
        try{
            $api = new KavenegarApi(env('KAVENEGAR_API_TOKEN'));
            $api->Send('',$bid->user->phone,$user_message);
            $api->Send('',$bid->demand->patient->phone,$patient_message);
        }
        catch(ApiException $e){
            echo $e->errorMessage();
        }
        catch(HttpException $e){
            echo $e->errorMessage();
        }
    }

    /**
     * @param mkey: key of message in lanfuage
     * @param bid: the bid
     */
    private static function getMessage(Bid $bid, $mkey){
        $plain = __('sms_templates.' . $mkey);
        $user = $bid->user->full_name;
        $patient = $bid->demand->patient->full_name;
        $unit = $bid->unit->complete_title;
        $plain = str_replace('USER', $user, $plain);
        $plain = str_replace('UNIT', $unit, $plain);
        $plain = str_replace('PATIENT', $patient, $plain);
        $plain = str_replace('REMAIN', $bid->price - $bid->deposit, $plain);
        $plain = str_replace('DEPOSIT', $bid->deposit, $plain);
        $plain = str_replace('BID_DATE', $bid->date_str, $plain);
        $plain = str_replace('GENDER', $bid->user->sir_madam, $plain);
        $plain = str_replace('GROUP_STR', $bid->user->group_str, $plain);
        return $plain;
    }
}