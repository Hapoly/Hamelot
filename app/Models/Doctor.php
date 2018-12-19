<?php

namespace App\Models;

use App\UModel;

use App\Models\ConstValue;
use Illuminate\Support\Facades\Storage;
use Webpatser\Uuid\Uuid;

class Doctor extends UModel{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    protected $primary = 'id';
    protected $table = 'doctors';
    protected $fillable = ['degree_id', 'field_id', 'user_id', 'profile', 'gender', 'msc', 'start_year'];

    public function getMscStrAttribute(){
        if($this->msc == 'NuLL')
            return '-';
        else
            return $this->msc;
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function degree(){
        return $this->belongsTo('App\Models\ConstValue', 'degree_id');
    }
    public function field(){
        return $this->belongsTo('App\Models\ConstValue', 'field_id');
    }
    public function getDegreeStrAttribute(){
        return ConstValue::find($this->degree_id)->value;
    }
    public function getFieldStrAttribute(){
        return ConstValue::find($this->field_id)->value;
    }
    
    const MALE      = 1;
    const FEMALE    = 2;
    public function getGenderStrAttribute(){
        return __('users.gender_str.' . $this->gender);
    }
    public function getSirMadamStrAttribute(){
        return __('users.sir_madam_str.' . $this->gender);
    }


    public function getProfileUrlAttribute(){
        if($this->profile == 'NuLL')
            if($this->gender == Doctor::MALE)
                return url('defaults\male.png');
            else
                return url('defaults\female.png');
        else
            return url($this->profile);
    }

    public function save(array $options = []){
        if(!$this->id)
            $this->id = Uuid::generate()->string;
        parent::save($options);
        $entry = Entry::where('target_id', $this->user->id)->where('group_code', Entry::DOCTOR)->first();
        $data = [
            'target_id'     => $this->user->id,
            'title'         => $this->user->full_name,
            'slug'          => $this->user->slug,
            
            'group_code'    => Entry::DOCTOR,
            'public'        => $this->user->public,
            'type'          => Entry::ACTUAL,
        ];
        
        if($this->status)
            $data['status'] = $this->status;
        if($entry){
            $entry->fill($data);
            $entry->save();  
        }else{
            Entry::create($data);
        }   
    }

    public function delete(){
        parent::delete();
        Storage::disk('public')->delete($this->image);
        Entry::where('target_id', $this->id)->where('group_code', Entry::DOCTOR)->delete();
    }

    public function getIsProfileCompletedAttribute(){
        if($this->user->first_name == 'NuLL' || $this->user->last_name == 'NuLL')
            return false;
        if(sizeof($this->user->fields) == 0)
            return false;
        if($this->start_year == 0 || $this->gender == 0 || $this->msc == 'NuLL')
            return false;
        return true;
    }
    public function getHasUnitAttribute(){
        if(sizeof($this->user->units) > 0)
            return true;
        return false;
    }
}
