<?php

namespace App\Http\Requests\Users\Edit;

use App\Http\Requests\PersianFormRequest;
use Illuminate\Validation\Rule;
use App\Rules\UUID;
use App\Rules\Phone;

class Nurse extends PersianFormRequest
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
            'degree_id'     => ['required', new UUID],
            'field_id'      => ['required', new UUID],
            'gender'        => 'required|numeric',
            'profile'       => 'image',
            'status'        => 'required|numeric',
            'public'        => 'required|numeric',
            'msc'           => 'required|string|max:16',
            'phone'         => ['required', new Phone, Rule::unique('users')->ignore($user_id)],
        ];
    }
}
