<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\PersianFormRequest;
use App\Rules\Phone;
use Auth;

class Register extends PersianFormRequest
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
        // die(json_encode(request()->all()));
        return [
            'username'      => 'required|string|unique:users',
            'password'      => 'required|string|confirmed',
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'group_code'    => 'required|numeric',
            'email'         => 'nullable|email',
            'phone'         => ['required', new Phone, 'unique:users'],
        ];
    }
}
