<?php

namespace App\Http\Requests\Profile\Edit;

use App\Http\Requests\PersianFormRequest;
use Illuminate\Validation\Rule;
use Auth;

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
    public function rules(){
        $user_id = Auth::user()->id;
        return [
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'slug'          => ['required', 'string', 'max:64', 'min:6', Rule::unique('users')->ignore($user_id)],
            'gender'        => 'required|numeric',
            'profile'       => 'image',
            'msc'           => 'required|string|max:16',
            'fields'        => 'required|string|min:5',
            'email'         => 'nullable|emial',
        ];
    }
}
