<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExperimentRequest extends FormRequest
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
            'patient_name'          => 'required|string',
            'department_id'         => 'required_if:action,new|numeric',
            'report_template_id'    => 'required|numeric',
            'year'                  => 'required|numeric',
            'month'                 => 'required|numeric',
            'day'                   => 'required|numeric',
        ];
    }
}