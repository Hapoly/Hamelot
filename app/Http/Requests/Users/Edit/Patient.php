<?php

namespace App\Http\Requests\Users\Edit;

use Illuminate\Foundation\Http\FormRequest;

class Patient extends FormRequest
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
            'username'      => 'required|string',
            'password'      => 'required_if:action,new|confirmed',
            'status'        => 'required|numeric',
            'profile'       => 'image',
            'id_number'     => 'required|numeric',
            'birth_year'    => 'required|numeric|min:1300|max:1400',
            'birth_month'   => 'required|numeric|min:1|max:12',
            'birth_day'     => 'required|numeric|min:1|max:31',
        ];
    }
}
