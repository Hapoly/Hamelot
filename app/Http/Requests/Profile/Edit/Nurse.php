<?php

namespace App\Http\Requests\Profile\Edit;

use Illuminate\Foundation\Http\FormRequest;

class Nurse extends FormRequest
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
            'degree'        => 'required|numeric',
            'field'         => 'required|numeric',
            'gender'        => 'required|numeric',
            'profile'       => 'image',
            'status'        => 'required|numeric',
            'public'        => 'required|numeric',
            'msc'           => 'required|string|max:16',
        ];
    }
}
