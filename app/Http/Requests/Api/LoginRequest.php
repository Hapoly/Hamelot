<?php

namespace App\Http\Requests\Api;

use Illuminate\Http\Request;

class LoginRequest extends ApiRequest{
    public $rules = [
        'username'      => 'required|string',
        'password'      => 'required|string',
        'remember_me'   => 'boolean'
    ];
}
