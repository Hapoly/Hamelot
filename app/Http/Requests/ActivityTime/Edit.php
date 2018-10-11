<?php

namespace App\Http\Requests\ActivityTime;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class Edit extends FormRequest
{
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
    public function rules()
    {
        return [
            'unit_user_id'      => 'required|string',
            'day_of_week'       => 'required|numeric|in:1,2,3,4,5,6,7',
            'start_timehour'    => 'required|numeric|min:0|max:23',
            'start_timeminute'  => 'required|numeric|min:0|max:59',
            'finish_timehour'   => 'required|numeric|min:0|max:23',
            'finish_timeminute' => 'required|numeric|min:0|max:59',
        ];
    }
}
