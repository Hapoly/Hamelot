<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ConstValue;

class Doctor extends Model
{
    protected $primary = 'id';
    protected $table = 'doctors';
    protected $fillable = ['degree', 'field', 'user_id', 'profile', 'gender', 'public', 'msc'];
    protected $visible = ['degree_str', 'field_str', 'profile_url'];

    protected $public_lang = [
        1   => 'عمومی',
        2   => 'خصوصی',
    ];
    public function getPublicStrAttribute(){
        return $this->public_lang[$this->public];
    }
    public function getMscStrAttribute(){
        if($this->msc == 'NuLL')
            return '';
        else
            return $this->msc;
    }


    public function user(){
        return $this->belongsTo('App\User');
    }
    public function getDegreeStrAttribute(){
        return ConstValue::find($this->degree)->value;
    }
    public function getFieldStrAttribute(){
        return ConstValue::find($this->field)->value;
    }
    public function getProfileUrlAttribute(){
        if($this->profile == 'NuLL')
            if($this->gender == 19)
                return url('defaults\male.png');
            else
                return url('defaults\female.png');
        else
            return url($this->profile);
    }
}
