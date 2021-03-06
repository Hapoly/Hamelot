<?php

namespace App\Http\Requests\Unit;

use App\Http\Requests\PersianFormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Rules\UUID;
use App\Rules\NotRegistered;
use App\Rules\Phone;
use App\User;
use App\Models\Entry;

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
    public function rules(Request $request){
        $unit_id = $this->route('unit')->id;
        $entry_id = Entry::where('target_id', $unit_id)->first()->id;
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
                                    Rule::unique('entries')->ignore($entry_id),
                                ],
            'address'       => 'required|string',
            'phone'         => 'required|string',
            'mobile'        => ['required', new NotRegistered(User::G_SECRETARY), new Phone],
            'lon'           => 'required|string',
            'lat'           => 'required|string',
            'city_id'       => ['required', new UUID],
            'parent_id'     => ['required', 'string'],
            'image'         => 'nullable|image',

            'status'        => 'required|numeric',
            'public'        => 'required|numeric',
            'type'          => 'required|numeric',
            'group_code'    => 'required|numeric',
        ];
    }
}
