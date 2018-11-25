<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class PersianFormRequest extends FormRequest{

    private function replace_digits($str){
        $digit_translates = [
            '۰' => '0',
            '۱' => '1',
            '۲' => '2',
            '۳' => '3',
            '۴' => '4',
            '۵' => '5',
            '۶' => '6',
            '۷' => '7',
            '۸' => '8',
            '۹' => '9',
        ];
        foreach($digit_translates as $persian=>$latina){
            $str = str_replace($persian, $latina, $str);
        }
        return $str;
    }
    public function getValidatorInstance(){
        foreach(request()->all() as $key=>$value){
            if($key == '_token')
                continue;
            
            // fixings
            $value = $this->replace_digits($value);
            // replace the fixes
            request()->merge([
                $key => $value,
            ]);
        }
        // die(json_encode(request()->all()));
        return parent::getValidatorInstance();
    }
}
