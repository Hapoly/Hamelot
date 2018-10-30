<?php

namespace App\Http\Requests;

use App\Http\Requests\PersianFormRequest;

class UserRequest extends PersianFormRequest
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
            'prefix'        => 'required|string',
            'username'      => 'required|string',
            'password'      => 'required_if:action,new|confirmed',
            'group_code'    => 'required|numeric',
            'status'        => 'required|numeric'
        ];
    }
}
