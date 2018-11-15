<?php

namespace App\Http\Requests\OffTime;

use App\Http\Requests\PersianFormRequest;
use Auth;
use App\Rules\UUID;

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
            'unit_user_id'      => ['required', new UUID],
            'start_date'        => 'required|numeric',
            'finish_date'       => 'required|numeric',
        ];
    }
}
