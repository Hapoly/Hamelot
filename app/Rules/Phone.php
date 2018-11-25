<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Phone implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
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
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // die($value);
        $value = $this->replace_digits($value);
        // die($value);
        preg_match("/09(10|11|12|13|14|15|16|17|18|19|90|91|30|33|35|36|37|38|39|01|02|03|04|05|41|20|21|22)([0-9]{7})/", $value);
        return  preg_match("/09(10|11|12|13|14|15|16|17|18|19|90|91|30|33|35|36|37|38|39|01|02|03|04|05|41|20|21|22)([0-9]{7})/", $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.phone');
    }
}
