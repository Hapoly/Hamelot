<?php

namespace App\Http\Requests\Template;

use App\Http\Requests\PersianFormRequest;
use Auth;

class FieldEdit extends PersianFormRequest {
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize() {
    return Auth::check();
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules() {
    return [
      'title' => 'required|string|max:100',
      'description' => 'required|string|max:1000',
      'status' => 'required|numeric|in:1,2',
      'type' => 'required|numeric',
      'unit' => 'required|string|max:20',

      'values.*' => 'required|string|max:500',
      'modes.*' => 'required|numeric|in:1,2',
      'descriptions.*' => 'required|string|max:1000',
      'min_ages.*' => 'nullable|numeric',
      'max_ages.*' => 'nullable|numeric',
      'min_weights.*' => 'nullable|numeric',
      'max_weights.*' => 'nullable|numeric',
      'genders.*' => 'required|numeric|in:1,2,3',
    ];
  }
}
