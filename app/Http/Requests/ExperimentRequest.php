<?php

namespace App\Http\Requests;

use App\Http\Requests\PersianFormRequest;

class ExperimentRequest extends PersianFormRequest
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
            'user_id'               => 'required|string',
            'unit_id'               => 'required|string',
            'report_template_id'    => 'required|string',
            'year'                  => 'required|numeric',
            'month'                 => 'required|numeric',
            'day'                   => 'required|numeric',
        ];
    }
}
