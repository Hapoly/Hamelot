<?php

namespace App\Http\Requests\Users\Edit;

use App\Http\Requests\PersianFormRequest;
use Illuminate\Validation\Rule;
use App\Rules\UUID;
use App\Rules\Phone;

use Auth;

class Nurse extends PersianFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return Auth::check();
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
            'slug'          => 'required|string|max:64|min:6',
            'gender'        => 'required|numeric',
            'profile'       => 'image',
            'public'        => 'required|numeric',
            'msc'           => 'required|string|max:16',
        ];
        if(Auth::user()->isAdmin()){
            $data['status'] = 'required|numeric';
            $data['phone'] = ['required', new Phone, Rule::unique('users')->ignore($user_id)];
        }
        return $data;
    }
}
