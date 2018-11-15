<?php

namespace App\Http\Requests\Unit;

use App\Http\Requests\PersianFormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Rules\UUID;

class Edit extends PersianFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $unit_id = $this->route('unit')->id;
        // die($unit_id);
        return [
            'title'         => 'required|string',
            'slug'          => [
                                    'required', 
                                    'string', 
                                    'max:32', 
                                    'min:4', 
                                    'regex:/[A-Z,a-z,1-9]*/i',
                                    Rule::unique('units')->ignore($unit_id),
                                ],
            'address'       => 'required|string',
            'phone'         => 'required|string',
            'mobile'        => 'required|string',
            'lon'           => 'required|string',
            'lat'           => 'required|string',
            'city_id'       => ['required', new UUID],
            'parent_id'     => ['required', new UUID],

            'status'        => 'required|numeric',
            'public'        => 'required|numeric',
            'type'          => 'required|numeric',
            'group_code'    => 'required|numeric',
        ];
    }
}
