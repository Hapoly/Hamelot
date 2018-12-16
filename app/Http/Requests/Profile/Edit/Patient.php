<?php

namespace App\Http\Requests\Profile\Edit;

use App\Http\Requests\PersianFormRequest;

class Patient extends PersianFormRequest
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
            'profile'       => 'image',
            'id_number'     => 'required|string|size:10',
            'birth_year'    => 'required|numeric|min:1300|max:1400',
            'birth_month'   => 'required|numeric|min:1|max:12',
            'birth_day'     => 'required|numeric|min:1|max:31',
            'email'         => 'nullable|email',
            'gender'        => 'required|numeric|in:1,2',
        ];
    }
}
