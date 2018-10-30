<?php

namespace App\Http\Requests\BankAccount;

use App\Http\Requests\PersianFormRequest;
use Auth;

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
            'title'             => 'required|string',
            'unit_id'           => 'required|string',
            'bank'              => 'required|numeric',
            'account_number'    => 'required|string',
            'sheba_number'      => 'required|string',
            'card_number'       => 'required|string',
            'owner_name'        => 'required|string',
        ];
    }
}
