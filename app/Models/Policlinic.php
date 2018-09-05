<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\User;

class Policlinic extends Model
{
    protected $primary = 'id';
    protected $table = 'policlinics';
    protected $fillable = ['title', 'address', 'description', 'image', 'type', 'status', 'public', 'phone', 'mobile', 'lon', 'lat', 'city_id'];
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


    const T_PUBLIC  = 1;
    const T_PRIVATE = 2;
    private $public_lang = [
        1   => 'عمومی',
        2   => 'خصوصی',
    ];
    public function getPublicStrAttribute(){
        return $this->public_lang[$this->public];
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
        return false;
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
                    return Policlinic::where('public', Policlinic::T_PUBLIC);
            case User::G_DOCTOR:
            case User::G_NURSE:
            case USER::G_PATIENT:
                if($joined)
                    return Policlinic::whereHas('requests', function($query){
                        return $query->where('department_user.user_id', Auth::user()->id)->where('status', UnitUser::ACCEPTED);
                    });
                else
                    return Policlinic::where('public', Policlinic::T_PUBLIC);
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
            'type'          => Entry::POLICLINIC,
        ];
        if($this->status)
            $data['status'] = ($this->status == Policlinic::ACTIVE && $this->public == Policlinic::T_PUBLIC)? Entry::ACTIVE: Entry::INACTIVE;
        else
            $data['status'] = (env('POLICLINIC_STATUS_DEFAULT') == Policlinic::ACTIVE && $this->public == Policlinic::T_PUBLIC)? Entry::ACTIVE: Entry::INACTIVE;

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


    public function requests(){
        return $this->hasMany('App\Models\UnitUser', 'department_id')->where('type', UnitUser::POLICLINIC);
    }

    public function users(){
        return $this->belongsToMany('App\User', 'department_user', 'department_id')
                    ->wherePivot('status', UnitUser::ACCEPTED)
                    ->wherePivot('type', UnitUser::POLICLINIC);
    }
    public function doctors(){
        return $this->users()->where('group_code', User::G_DOCTOR);
    }
    public function nurses(){
        return $this->users()->where('group_code', User::G_NURSE);
    }
    public function hasEditPermission(){
        if(Auth::user()->isAdmin())
            return true;
        if(Auth::user()->isManager()){
            return $this->hospital->whereHas('users', function($query){
                return $query->where('users.id', Auth::user()->id);
            })->first() != null;
        }
        if(Auth::user()->isPatient() || Auth::user()->isNurse() || Auth::user()->isDoctor())
            return false;
        return false;
    }

    public function joined(){
        return $this->users()->where('users.id', Auth::user()->id)->where('department_user.status', UnitUser::ACCEPTED)->first() != null;
    }
    public function pending(){
        return $this->users()->where('users.id', Auth::user()->id)->where('department_user.status', UnitUser::PENDNIG)->first() != null;
    }
    public function hasRequest(){
        return $this->users()->where('users.id', Auth::user()->id)->first() != null;
    }
    public function lastRequest(){
        return $this->requests()->where([
            'user_id'   => Auth::user()->id,
        ])->orderBy('created_at', 'desc')->first();
    }
    public function canJoin(){
        if(Auth::user()->isAdmin() || Auth::user()->isManager() || Auth::user()->isPatient())
            return false;
        $lastRequest = $this->lastRequest();
        if($lastRequest){
            if($lastRequest->status == UnitUser::REFUSED || $lastRequest->status == UnitUser::CANCELED)
                return true;
            else
                return false;
        }else
            return true;
    }
}
