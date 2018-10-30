<?php

namespace App\Http\Requests;

use App\Http\Requests\PersianFormRequest;

class ReportTemplateRequest extends PersianFormRequest
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
            'title'         => 'required|string|max:32',
            'description'   => 'required|string|max:200',
            'status'        => 'required|numeric|in:1,2',
            'titles.*'      => 'required|string|max:32',
            'descriptions.*'=> 'required|string|max:200',
            'labels.*'      => 'required|string|max:16',
            'types.*'       => 'required|numeric|in:1,2,3,4,5',
        ];
    }
}
