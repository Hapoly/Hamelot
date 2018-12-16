<?php

namespace App\Http\Requests\Users\Edit;

use App\Http\Requests\PersianFormRequest;
use Auth;
class Secretary extends PersianFormRequest{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
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
            'phone'         => ['required', new Phone, 'unique:users'],
            'email'         => 'nullable|email',
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'status'        => 'required|numeric',
        ];
    }
}
