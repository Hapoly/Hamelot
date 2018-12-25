<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\ApiRequest;
use App\Rules\Phone;

use Auth;

class TokenSend extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            'phone'             => [ 'required', new Phone ],
            'group_code'        => 'required|numeric',
            'accepted_terms'    => 'required|accepted',
        ];
    }
}
