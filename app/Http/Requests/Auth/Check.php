<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\PersianFormRequest;
use App\Rules\Phone;
use App\Rules\Token;
use Auth;

class Check extends PersianFormRequest
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
    public function rules(){
        return [
            'token'     => ['required_if:action,check', new Token(request()->get('token'))],
            'action'    => ['required', 'string'],
        ];
    }
}
