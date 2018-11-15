<?php

namespace App\Http\Requests\Demand;

use App\Http\Requests\PersianFormRequest;
use Auth;
use App\Rules\UUID;

class CreateFree extends PersianFormRequest
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
            'description'   => 'required|string',
            'address_id'    => ['required', new UUID],
            'asap'          => 'required|numeric|in:0,1',
            'start_time'    => 'required_if:asap,0|string',
            'end_time'      => 'required_if:asap,0|string',
            'image'         => 'image',
        ];
    }
}
