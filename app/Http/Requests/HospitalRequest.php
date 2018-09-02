<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HospitalRequest extends FormRequest
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
            'address'       => 'required|string',
            'phone'         => 'required|string',
            'mobile'        => 'required|string',
            'status'        => 'required|numeric',
            'image'         => 'image',
            'lon'           => 'required|string',
            'lat'           => 'required|string',
            'city_id'       => 'required|numeric',
        ];
    }
}
