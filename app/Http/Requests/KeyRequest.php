<?php

namespace App\Http\Requests;

use App\Http\Requests\PersianFormRequest;
use App\Rules\UUID;

class KeyRequest extends PersianFormRequest
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
            'description'   => 'required|string',
            'status'        => 'required|numeric',
            'type'          => 'required|numeric',
            'template_id'   => ['required', new UUID],
        ];
    }
}
