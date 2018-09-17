<?php

namespace App\Http\Requests\Api\Register;

use Illuminate\Http\Request;
use App\Http\Requests\Api\ApiRequest;
use Validator;

class DoctorRequest extends ApiRequest{
    public $rules = [
        'first_name'    => 'required|string',
        'last_name'     => 'required|string',
        'username'      => 'required|string|unique:users',
        'password'      => 'required|string',
        'public'        => 'required|numeric|in:1,2',
        'gender'        => 'required|numeric|in:1,2',
        'degree'        => 'required|numeric',
        'field'         => 'required|numeric',
        'msc'           => 'required|string',
        'profile'       => 'image|max:250',
    ];
}
