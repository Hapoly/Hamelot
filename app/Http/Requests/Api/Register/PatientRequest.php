<?php

namespace App\Http\Requests\Api\Register;

use Illuminate\Http\Request;
use Validator;

class PatientRequest{
    const rules = [
        'first_name'    => 'required|string',
        'last_name'     => 'required|string',
        'username'      => 'required|string|unique:users',
        'password'      => 'required|string',
        'gender'        => 'required|numeric|in:1,2',
        'profile'       => 'image|max:250',
        'birth_date'    => 'required|numeric',
        'id_number'     => 'required|string',
    ];

    private $validator;
    public function __construct(Request $request){
        $this->validator = Validator::make($request->all(), PatientRequest::rules);
    }
    public function fails(){
        return $this->validator->fails();
    }
    public function errors(){
        $error_codes = (array) $this->validator->failed();
        $error_messages = $this->validator->errors();
        $resutls = [];
        foreach($error_codes as $field => $errors){
            foreach((array) $errors as $error => $disp){
                array_push($resutls, [
                    'field' => $field,
                    'code'  => $field . '_' . $error,
                    'message'   => $error_messages->first($field),
                ]);
            }
        }
        return $resutls;
    }
}
