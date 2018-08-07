<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

class Permissions extends Controller
{
    public function create(Request $request, User $user){
        return 'test';
    }
}
