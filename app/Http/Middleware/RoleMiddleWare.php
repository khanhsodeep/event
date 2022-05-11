<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class RoleMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {   
        echo Auth::user()->username;
        if (Auth::user()->role->name != $role){
            return redirect()->route('login');
        }
        return $next($request);
    }
}
