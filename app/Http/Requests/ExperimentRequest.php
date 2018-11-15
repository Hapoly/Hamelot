<?php

namespace App\Http\Requests;

use App\Http\Requests\PersianFormRequest;
use App\Rules\UUID;

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
            'user_id'               => ['required', new UUID],
            'unit_id'               => ['required', new UUID],
            'report_template_id'    => ['required', new UUID],
            'year'                  => 'required|numeric',
            'month'                 => 'required|numeric',
            'day'                   => 'required|numeric',
        ];
    }
}
