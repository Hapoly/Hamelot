<?php

namespace App\Http\Requests\Unit;

use App\Http\Requests\PersianFormRequest;
use App\Rules\UUID;

class Create extends PersianFormRequest
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
            'title'         => 'required|string',
            'slug'          => 'required|string|max:32|min:4|unique:units',
            'address'       => 'required|string',
            'phone'         => 'required|string',
            'mobile'        => 'required|string',
            // 'image'         => 'required|image',
            'lon'           => 'required|string',
            'lat'           => 'required|string',
            'city_id'       => ['required', new UUID],
            'parent_id'     => 'required|string',

            'status'        => 'required|numeric',
            'public'        => 'required|numeric',
            'type'          => 'required|numeric',
            'group_code'    => 'required|numeric',
        ];
    }
}
