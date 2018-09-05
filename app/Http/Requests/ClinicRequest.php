<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClinicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
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
            'address'       => 'required|string',
            'phone'         => 'string',
            'mobile'        => 'string',
            'image'         => 'image',
            'lon'           => 'required|string',
            'lat'           => 'required|string',
            'city_id'       => 'required|numeric',
            'type'          => 'required|numeric',
            'doctor_name'   => 'string',
        ];
    }
}
