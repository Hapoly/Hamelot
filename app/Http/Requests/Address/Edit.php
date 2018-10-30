<?php

namespace App\Http\Requests\Address;

use App\Http\Requests\PersianFormRequest;
use Auth;

class Edit extends PersianFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
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
            'plain'         => 'required|string',
            'city_id'       => 'required|string',
            'lon'           => 'string',
            'lat'           => 'string',
            'phone'         => 'required|string',
        ];
    }
}
