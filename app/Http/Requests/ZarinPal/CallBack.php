<?php

namespace App\Http\Requests\ZarinPal;

use App\Http\Requests\PersianFormRequest;
use Auth;

class CallBack extends PersianFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'Status'        => 'required|string',
            'Authority'     => 'required|string',
        ];
    }
}
