<?php

namespace App\Http\Requests\Transaction;

use App\Http\Requests\PersianFormRequest;
use Auth;
use App\Rules\UUID;

class CreateWithdraw extends PersianFormRequest
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
            'bank_account_id'   => ['required', new UUID],
            'amount'            => 'required|numeric|min:' . env('MIN_WITHDRAW_AMOUNT'),
            'date'              => 'required|numeric',
        ];
    }
}
