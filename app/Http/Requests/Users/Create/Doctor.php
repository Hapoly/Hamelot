<?php

namespace App\Http\Requests\Users\Create;

use App\Http\Requests\PersianFormRequest;
use App\Rules\UUID;
use App\Rules\Phone;

use Auth;

class Doctor extends PersianFormRequest
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
            'gender'        => 'required|numeric',
            'profile'       => 'image',
            'public'        => 'required|numeric',
            'phone'         => ['required', new Phone, 'unique:users'],
            'msc'           => 'required|string|max:16',
            'email'         => 'nullable|email',
        ];
        if(Auth::user()->isAdmin())
            $data['status'] = 'required|numeric';
        return $data;
    }
}
