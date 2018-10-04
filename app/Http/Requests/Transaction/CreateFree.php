<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class CreateFree extends FormRequest
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
            'target_type'   => 'required|numeric',
            'user_id'       => 'required:target_type,1',
            'unit_id'       => 'required_if:target_type,2',
            'amount'        => 'required|numeric',
            'date'          => 'required|numeric',
        ];
    }
}
