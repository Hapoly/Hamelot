<?php

namespace App\Http\Requests\Users\Create;

use App\Http\Requests\PersianFormRequest;
use App\Rules\Phone;

use Auth;

class Patient extends PersianFormRequest
{
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
        $data = [
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'profile'       => 'image',
            'id_number'     => 'required|numeric',
            'birth_year'    => 'required|numeric|min:1300|max:1400',
            'birth_month'   => 'required|numeric|min:1|max:12',
            'birth_day'     => 'required|numeric|min:1|max:31',
            'phone'         => ['required', new Phone, 'unique:users', 'unique:entries'],
            'email'         => 'nullable|email',
        ];
        if(Auth::user()->isAdmin())
            $data['status'] = 'required|numeric';
        return $data;
    }
}
