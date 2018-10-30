<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\PersianFormRequest;
use Auth;

class CreatePatient extends PersianFormRequest
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
            'token'         => 'required|string|max:6',
            'id_number'     => 'required|string',
            'birth_date'    => 'required|numeric',
            'profile'       => 'required|image|max:256',
            'gender'        => 'required|numeric',
        ];
    }
}
