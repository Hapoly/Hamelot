<?php

namespace App\Http\Requests\Api;

use Illuminate\Http\Request;
use Validator;

class ApiRequest{

    protected $validator;
    public function fails(){
        return $this->validator->fails();
    }
    public function __construct(Request $request){
        $this->validator = Validator::make($request->all(), $this->rules);
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
