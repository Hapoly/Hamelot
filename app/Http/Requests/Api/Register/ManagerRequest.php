<?php

namespace App\Http\Requests\Api\Register;

use App\Http\Requests\Api\ApiRequest;

class ManagerRequest extends ApiRequest{
    public $rules = [
        'first_name'    => 'required|string',
        'last_name'     => 'required|string',
        'username'      => 'required|string|unique:users',
        'password'      => 'required|string',
    ];
}
