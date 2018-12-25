<?php
namespace App\Http\Requests\Api;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest as LaravelFormRequest;
abstract class ApiRequest extends LaravelFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules();
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    abstract public function authorize();
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $messages = $validator->errors()->messages();
        $fails = $validator->failed();
        $results = [];
        foreach($fails as $field=>$fail){
            $i = 0;
            foreach($fail as $rule=>$exps){
                array_push($results, [
                    'field'     => $field,
                    'error'     => $field . $rule,
                    'message'   => $messages[$field][$i],
                ]);
                $i ++;
            }
        }
        throw new HttpResponseException(response()->json($results , JsonResponse::HTTP_BAD_REQUEST));
    }
}