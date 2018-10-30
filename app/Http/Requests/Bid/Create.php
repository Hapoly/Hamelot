<?php

namespace App\Http\Requests\Bid;

use App\Http\Requests\PersianFormRequest;
use Auth;

class Create extends PersianFormRequest
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
            'target'        => 'required|string',
            'date'          => 'required|numeric',
            'price'         => 'required|numeric',
            'deposit'       => 'required|numeric',
        ];
    }
}
