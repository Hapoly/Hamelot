<?php

namespace App\Http\Requests\Api\Register;

use Illuminate\Http\Request;
use App\Http\Requests\Api\ApiRequest;
use Validator;

class PatientRequest extends ApiRequest{
    public $rules = [
        'first_name'    => 'required|string',
        'last_name'     => 'required|string',
        'username'      => 'required|string|unique:users',
        'password'      => 'required|string',
        'gender'        => 'required|numeric|in:1,2',
        'profile'       => 'image|max:250',
        'birth_date'    => 'required|numeric',
        'id_number'     => 'required|string',
    ];
}
