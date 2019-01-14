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
      'description' => 'required|string|max:500',
      'status' => 'required|numeric|in:1,2',
    ];
  }
}
