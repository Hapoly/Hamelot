<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\User;

class NotRegistered implements Rule{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $group_code = 0;
    public function __construct($group){
        $this->group_code = $group;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value){
        $user = User::where('phone', $value)->first();
        if($user){
            return $user->group_code == $this->group_code;
        }else{
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(){
        return __('validation.not_registered', ['group' => __('users.group_str.' . $this->group_code)]);
    }
}
