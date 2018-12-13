<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\PersianFormRequest;
use Auth;

class CreateNurse extends PersianFormRequest
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
            'msc'           => 'required|string',
            'feilds'        => 'required|string',
            'profile'       => 'image|mimes:jpeg',
            'gender'        => 'required|numeric',
            'city_id'       => ['required', new UUID, 'exists:cities'],
            'address'       => 'required|string|max:200',
            'slug'          => 'required|string|max:32|min:4|unique:units',
            'phone'         => 'required|string',
            'mobile'        => 'required|string',
        ];
    }
}
