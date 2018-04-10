<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;
class IsManager
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
        if(Auth::user()->group_code == User::G_MANAGER)
            return $next($request);
        else
            return abort(403);
    }
}
