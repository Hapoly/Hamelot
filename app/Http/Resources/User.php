<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

use App\User as UserModel;

class User extends Resource{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request){
        $data = [
            'id'            => $this->id,
            "phone"         => $this->phone,
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            "email"         => $this->email,
            "group_code"    => $this->group_code,
            "slug"          => $this->slug,
        ];
        switch($this->group_code){
            case UserModel::G_DOCTOR:
                $data['msc'] = $this->doctor->msc;
                $data['fields'] = $this->fields;
                $data['start_year'] = $this->doctor->start_year;
                $data['profile_url'] = $this->doctor->profile_url;
                break;
            case UserModel::G_PATIENT:
                $data['gender'] = $this->patient->gender;
                $data['id_number'] = $this->patient->id_number;
                $data['birth_date'] = $this->patient->birth_date;
                $data['profile_url'] = $this->patient->profile_url;
                break;
        }
        return $data;
    }
}
