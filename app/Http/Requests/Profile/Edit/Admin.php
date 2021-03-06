<?php

namespace App\Http\Requests\Profile\Edit;

use App\Http\Requests\PersianFormRequest;

class Admin extends PersianFormRequest
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
            'email'         => 'nullable|email',
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
        ];
    }
}
