<?php

namespace App\Http\Requests\Users\Edit;

use App\Http\Requests\PersianFormRequest;
use Illuminate\Validation\Rule;
use Auth;
use App\Models\Entry;
class Secretary extends PersianFormRequest{
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
    public function rules(){
        $user_id = $this->route('user')->id;
        $entry_id = Entry::where('target_id', $unit_id)->first()->id;
        return [
            'email'         => 'nullable|email',
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'slug'          => ['required', 'string', Rule::unique('users')->ignore($user_id), Rule::unique('entries')->ignore($entry_id),]
        ];
        if(Auth::user()->isAdmin()){
            $data['status'] = 'required|numeric';
            $data['phone'] = ['required', new Phone, Rule::unique('users')->ignore($user_id)];
        }
        return $data;
    }
}
