<?php

namespace App\Http\Middleware;

use Closure;

class LoginAdmin
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
        $data = $request->session()->get('auth');
        if($data) {
            // return redirect()->route('admin.dashboard');
            return $next($request);
        } else {
            return redirect()->route('admin.login');
        }
    }
}
