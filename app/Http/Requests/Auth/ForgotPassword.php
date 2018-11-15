<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\PersianFormRequest;
use App\Rules\Phone;
use Auth;

class ForgotPassword extends PersianFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone'         => ['required', new Phone, 'exists:users'],
        ];
    }
}