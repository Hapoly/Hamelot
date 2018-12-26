<?php
namespace App\Rules;

use DB;
use Illuminate\Contracts\Validation\Rule;

class Exists implements Rule{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    protected $table = null;
    protected $array = false;

    public function __construct($table, $array=false){
        $this->table = $table;
        $this->array = $array;
    }
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value){
        if($this->array){
            $result = true;
            foreach($value as $id)
                if(DB::table($this->table)->where('id', $id)->first() == null)
                    $result = false;
            return $result;
        }else
            return DB::table($this->table)->where('id', $value)->first() != null;
    }
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.table_exists', ['table' => $this->table]);
    }
}
