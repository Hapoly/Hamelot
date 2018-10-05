<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class CreateDoctor extends FormRequest
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
            'username'      => 'required|string|unique:users',
            'password'      => 'required|string',
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'group_code'    => 'required|numeric',
            
            'msc'           => 'required|string',
            'degree_id'     => 'required|string',
            'field_id'      => 'required|string',
            'public'        => 'required|numeric',
            'profile'       => 'required|image|max:256',
            'gender'        => 'required|numeric',
        ];
    }
}
