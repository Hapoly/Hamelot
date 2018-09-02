<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\User;

class Policlinic extends Model
{
    protected $primary = 'id';
    protected $table = 'policlinics';
    protected $fillable = ['title', 'address', 'description', 'image', 'type', 'status', 'phone', 'lon', 'lat', 'city_id'];
    protected $appends = ['image_url'];

    const ACTIVE    = 1;
    const INACTIVE  = 2;
    private $status_lang = [
        1   => 'فعال',
        2   => 'غیرفعال',
    ];
    public function getStatusStrAttribute(){
        return $this->status_lang[$this->status];
    }

    const ACTUAL    = 1;
    const VIRTUAL   = 2;
    private $type_lang = [
        1   => 'واقعی',
        2   => 'مجازی',
    ];
    public function getTypeStrAttribute(){
        return $this->type_lang[$this->type];
    }

    public function city(){
        return $this->belongsTo('App\Models\City');
    }

    public function getImageUrlAttribute(){
        if($this->image == 'NuLL')
            return url('/defaults/hospital.png');
        else
            return url($this->image);
    }

    public function getJoinedAttribute(){
        if(Auth::user()->isManager())
            return $this->users()->where('users.id', Auth::user()->id)->first() != null;
        else if(Auth::user()->isAdmin() || Auth::user()->isPatient())
            return false;
        else
            return $this->departments()->whereHas('users', function($query){
                return $query->where(['users.id'=> Auth::user()->id]);
            })->first() != null;
    }

    public static function fetch($joined){
        switch(Auth::user()->group_code){
            case User::G_ADMIN:
                return (new Policlinic);
            case User::G_MANAGER:
                if($joined)
                    return Policlinic::whereHas('users', function($query){
                        return $query->where('users.id', Auth::user()->id);
                    });
                else
                    return new Policlinic;
            case User::G_DOCTOR:
            case User::G_NURSE:
            case USER::G_PATIENT:
                if($joined)
                    return Policlinic::whereHas('requests', function($query){
                        return $query->where('department_user.user_id', Auth::user()->id)->where('status', DepartmentUser::ACCEPTED);
                    });
                else
                    return new Policlinic;
        }
    }

    public function save(array $options = []){
        parent::save($options);
        $entry = Entry::where('target_id', $this->id)->where('type', Entry::POLICLINIC)->first();
        $data = [
            'target_id'     => $this->id,
            'title'         => $this->title,
            'lon'           => $this->lon,
            'lat'           => $this->lat,
            'city_id'       => $this->city_id,
            'province_id'   => $this->city->province_id,
            'status'        => $this->status,
            'type'          => Entry::POLICLINIC,
        ];
        if($entry){
            $entry->fill($data);
            $entry->save();  
        }else{
            Entry::create($data);
        }   
    }

    public function delete(){
        parent::delete();
        Entry::where('target_id', $this->id)->where('type', Entry::POLICLINIC)->delete();
    }

    public function getHasPermissionAttribute(){
        if(Auth::user()->isAdmin())
            return true;
        else if(Auth::user()->isManager())
            return $this->users()->where('users.id', Auth::user()->id)->first() != null;
        else
            return false;
    }

    public function getPhoneStrAttribute(){
        if($this->phone == 'NuLL')
            return '-';
        else
            return $this->phone;
    }
    public function getMobileStrAttribute(){
        if($this->mobile == 'NuLL')
            return '-';
        else
            return $this->mobile;
    }

    public function getAddressSummaryAttribute(){
        return substr($this->address, 0, 30) . '...';
    }
}
