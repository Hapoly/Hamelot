<?php

namespace App\Http\Requests\Users\Create;

use App\Http\Requests\PersianFormRequest;

class Manager extends PersianFormRequest
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
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'username'      => 'required|string|unique:users',
            'password'      => 'required_if:action,new|confirmed',
            'status'        => 'required|numeric'
        ];
    }
}
