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
            'gender'        => 'required|numeric',
            'profile'       => 'image',
            'msc'           => 'required|string|max:16',
            'fields'        => 'required|string|min:5',
            'start_year'    => 'required|numeric',
            'email'         => 'nullable|email',
        ];
    }
}
