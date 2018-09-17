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
            'username'      => $this->username,
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'group_code'    => $this->group_code,
            'group_str'     => $this->group_str,
            'permissions'   => [
                'readings'  => [
                    'info'  => $this->permission_to_read_info
                ],
                'writing'   => [
                    'info'  => $this->permission_to_write_info
                ],
            ],
        ];
        if($this->group_code == UserModel::G_PATIENT){
            $data['gender']         = $this->patient->gender;
            $data['gender_str']     = $this->patient->gender_str;
            $data['id_number']      = $this->patient->id_number;
            $data['id_number_str']  = $this->patient->id_number_str;
            $data['profile']        = $this->patient->profile;
            $data['profile_url']    = $this->patient->profile_url;
            $data['permissions']['reading']['history'] = $this->permission_to_read_history;
            $data['permissions']['writing']['history'] = $this->permission_to_write_history;
        }
        if($this->group_code == UserModel::G_DOCTOR){
            $data['gender']         = $this->doctor->gender;
            $data['gender_str']     = $this->doctor->gender_str;
            $data['degree']         = $this->doctor->degree;
            $data['field']          = $this->doctor->field;
            $data['degree_str']     = $this->doctor->degree_str;
            $data['field_str']      = $this->doctor->field_str;
            $data['profile']        = $this->doctor->profile;
            $data['profile_str']    = $this->doctor->profile_str;
            $data['msc']            = $this->doctor->msc;
            $data['msc_str']        = $this->doctor->msc_str;
            $data['permissions']['reading']['unit'] = $this->permission_to_read_unit;
            $data['permissions']['writing']['unit'] = $this->permission_to_write_unit;
        }
        if($this->group_code == UserModel::G_NURSE){
            $data['gender']         = $this->nurse->gender;
            $data['gender_str']     = $this->nurse->gender_str;
            $data['degree']         = $this->nurse->degree;
            $data['field']          = $this->nurse->field;
            $data['degree_str']     = $this->nurse->degree_str;
            $data['field_str']      = $this->nurse->field_str;
            $data['profile']        = $this->nurse->profile;
            $data['profile_str']    = $this->nurse->profile_str;
            $data['msc']            = $this->nurse->msc;
            $data['msc_str']        = $this->nurse->msc_str;
            $data['permissions']['reading']['unit'] = $this->permission_to_read_unit;
            $data['permissions']['writing']['unit'] = $this->permission_to_write_unit;
        }
        return $data;
    }
}
