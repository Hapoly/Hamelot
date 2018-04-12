<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;
class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->group_code == User::G_ADMIN){
            return $next($request);
        }else
            return abort(403);
    }
}
