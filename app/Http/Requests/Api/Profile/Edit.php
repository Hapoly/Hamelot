<?php

namespace App\Http\Requests\Api\Profile;

use App\Http\Requests\Api\ApiRequest;

use App\User;

use Auth;

class Edit extends ApiRequest{
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
    public function rules(){
        $rules = [
            'first_name'        => 'nullable|string|max:32',
            'last_name'         => 'nullable|string|max:32',
            'email'             => 'nullable|email',
            'slug'              => 'nullable|string|unique:users',
        ];
        switch(Auth::user()->group_code){
            case User::G_PATIENT:
                $rules['gender'] = 'nullable|numeric';
                $rules['id_number'] = 'nullable|string|max:10';
                $rules['birth_date'] = 'nullable|numeric';
                $rules['profile_url'] = 'nullable|image';
                break;
            case User::G_DOCTOR:
                $rules['msc'] = 'nullable|string';
                $rules['fields.*'] = 'nullable|uuid';
                $rules['start_year'] = 'nullable|numeric';
                $rules['profile_url'] = 'nullable|image';
                break;
        }
        return $rules;
    }
}
