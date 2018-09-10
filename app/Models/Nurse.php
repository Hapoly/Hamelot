<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ConstValue;
use Illuminate\Support\Facades\Storage;

class Nurse extends Model
{
    protected $primary = 'id';
    protected $table = 'nurses';
    protected $fillable = ['degree', 'field', 'user_id', 'profile', 'gender', 'msc'];
    protected $visible = ['degree_str', 'field_str', 'profile_url'];

    public function getMscStrAttribute(){
        if($this->msc == 'NuLL')
            return '-';
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

    public function save(array $options = []){
        parent::save($options);
        $entry = Entry::where('target_id', $this->id)->where('group_code', Entry::NURSE)->first();
        $data = [
            'target_id'     => $this->id,
            'title'         => $this->user->full_name,

            'degree'        => $this->degree,
            'field'         => $this->field,
            
            'group_code'    => Entry::NURSE,
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
        Entry::where('target_id', $this->id)->where('group_code', Entry::NURSE)->delete();
    }
}
