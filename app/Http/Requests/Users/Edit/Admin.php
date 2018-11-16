<?php

namespace App\Http\Requests\Users\Edit;

use App\Http\Requests\PersianFormRequest;
use Illuminate\Validation\Rule;
use App\Rules\Phone;

class Admin extends PersianFormRequest
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
        $user_id = $this->route('user')->id;
        return [
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'username'      => ['required', Rule::unique('users')->ignore($user_id)],
            'password'      => 'required_if:action,new|confirmed',
            'status'        => 'required|numeric',
            'phone'         => ['required', new Phone, Rule::unique('users')->ignore($user_id)],
        ];
    }
}
