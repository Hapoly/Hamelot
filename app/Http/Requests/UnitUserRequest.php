<?php

namespace App\Http\Requests;

use App\Http\Requests\PersianFormRequest;

class UnitUserRequest extends PersianFormRequest
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
            'full_name'         => 'required|string',
            'unit_id'           => 'required|string',
            'permission'        => 'required|numeric',
        ];
    }
}
