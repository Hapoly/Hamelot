<?php

namespace App\Http\Requests;

use App\Http\Requests\PersianFormRequest;
use App\Rules\UUID;

class UnitUserManageRequest extends PersianFormRequest
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
            'full_name'     => 'required|string',
            'unit_id'       => ['required', new UUID],
            'type'          => 'required|numeric|in:1,2,3,4',
        ];
    }
}
