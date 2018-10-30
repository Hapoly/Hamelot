<?php

namespace App\Http\Requests\Profile\Edit;

use App\Http\Requests\PersianFormRequest;

class Doctor extends PersianFormRequest
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
            'password'      => 'confirmed',
            'degree_id'        => 'required|string',
            'field_id'         => 'required|string',
            'gender'        => 'required|numeric',
            'profile'       => 'image',
            'public'        => 'required|numeric',
            'msc'           => 'required|string|max:16',
        ];
    }
}
