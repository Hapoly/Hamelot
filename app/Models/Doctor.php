<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ConstValue;

class Doctor extends Model
{
    protected $primary = 'id';
    protected $table = 'doctors';
    protected $fillable = ['degree', 'field', 'user_id', 'profile', 'gender'];
    protected $visible = ['degree_str', 'field_str'];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function getDegreeStrAttribute(){
        return ConstValue::find($this->degree)->value;
    }
    public function getFieldStrAttribute(){
        return ConstValue::find($this->field)->value;
    }
}
