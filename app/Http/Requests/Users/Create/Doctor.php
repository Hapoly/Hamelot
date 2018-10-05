<?php

namespace App\Http\Requests\Users\Create;

use Illuminate\Foundation\Http\FormRequest;

class Doctor extends FormRequest
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
            'degree_id'        => 'required|string',
            'field_id'         => 'required|string',
            'gender'        => 'required|numeric',
            'profile'       => 'image',
            'status'        => 'required|numeric',
            'public'        => 'required|numeric',
            'msc'           => 'required|string|max:16',
        ];
    }
}
