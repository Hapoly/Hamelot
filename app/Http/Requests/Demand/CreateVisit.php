<?php

namespace App\Http\Requests\Demand;

use App\Http\Requests\PersianFormRequest;
use Auth;

class CreateVisit extends PersianFormRequest
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
    public function rules(){
        $rules = [
            'description'   => 'nullable|string',
        ];
        if(Auth::user()->first_name == 'NuLL')
            $rules['first_name'] = 'required|string|max:32';
        if(Auth::user()->last_name == 'NuLL')
            $rules['last_name'] = 'required|string|max:32';
        if(Auth::user()->id_number == 'NuLL')
            $rules['id_number'] = 'required|string|max:32';
        if(Auth::user()->gender == 0)
            $rules['gender'] = 'required|numeric|in:1,2';
        if(Auth::user()->birth_date == 0){
            $rules['birth_year']    = 'required|numeric';
            $rules['birth_month']   = 'required|numeric';
            $rules['birth_day']     = 'required|numeric';
        }
        return $rules;
    }
}
