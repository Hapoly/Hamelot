<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use URL;
use Auth;

use App\User;
use App\Models\UserConst;

use App\Http\Requests\Api\Profile\Edit as ProfileEditRequest;

use App\Http\Resources\User as UserResource;

class Profile extends Controller{
    public function get(Request $request){
        return UserResource::make(Auth::user());
    }
    public function edit(ProfileEditRequest $request){
        $user = Auth::user();
        $user->fill($request->only([
            'first_name',
            'last_name',
            'email',
            'slug',
        ]))->save();

        switch($user->group_code){
            case User::G_PATIENT:
                $patient = $user->patient;
                $patient->fill($request->only([
                    'id_number',
                    'gender',
                    'birth_date',
                ]))->save();
                if($request->hasFile('profile')){
                    Storage::disk('public')->delete($patient->profile);
                    $patient->profile = Storage::disk('public')->put('/users', $request->file('profile'));
                    $patient->save();   
                }
                break;
            
            case User::G_DOCTOR:
                $doctor = $user->doctor;
                $doctor->fill($request->only([
                    'msc',
                    'start_year',
                ]))->save();
                if($request->hasFile('profile')){
                    Storage::disk('public')->delete($doctor->profile);
                    $doctor->profile = Storage::disk('public')->put('/users', $request->file('profile'));
                    $doctor->save();   
                }
                if($request->has('fields')){
                    UserConst::where('user_id', $user->id)->delete();
                    foreach($request->fields as $field_id){
                        UserConst::create([
                            'user_id'   => $user->id,
                            'const_id'  => $field_id,
                        ]);
                    }
                }
                break;
        }

        return [
            'message'   => 'client\'s profile edited.'
        ];
    }
}