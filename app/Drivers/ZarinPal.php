<?php
namespace App\Drivers;
/**
 * ZarinPal library
 * this library handles transactions
 * 
 * @author  mr-exception
 * @license GNU/LGPL
 * @version 1.0.0
 */
class ZarinPal {
    public static function generate($amount, $description, $callback){
        $data = array(
            'MerchantID' => env('ZARIN_PAL_MERCHANT_ID'),
            'Amount' => $amount,
            'CallbackURL' => $callback,
            'Description' => $description,
        );
        $jsonData = json_encode($data);
        $ch = curl_init('https://'. env('ZARIN_PAL_PROTOCOL') .'.zarinpal.com/pg/rest/WebGate/PaymentRequest.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
            )
        );
        $result = curl_exec($ch);
        $err = curl_error($ch);
        $result = json_decode($result, true);
        curl_close($ch);
        if($err){
            return false;
        }else{
            if($result["Status"] == 100){
                return $result["Authority"];
            }else{
                return false;
            }
        }
    }

    public static function generateLink($authority){
        return "https://". env('ZARIN_PAL_PROTOCOL') .".zarinpal.com/pg/StartPay/$authority";
    }

    public static function verify($amount, $authority){
        $data = array('MerchantID' => env('ZARIN_PAL_MERCHANT_ID'), 'Authority' => $authority, 'Amount' => $amount);
        $jsonData = json_encode($data);
        $ch = curl_init('https://'. env('ZARIN_PAL_PROTOCOL') .'.zarinpal.com/pg/rest/WebGate/PaymentVerification.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
            )
        );
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $result = json_decode($result, true);
        if ($err) {
            return false;
        } else {
            if ($result['Status'] == 100) {
                return true;
            } else {
                return false;
            }
        }
    }
}
