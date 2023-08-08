<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Redirect;

class CheckRoleMiddleware extends Middleware
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
        if(Auth::user()->role == $role){
        return $next($request);
        }
        else
        {
            if(Auth::user()->role == '1')
            {
                return redirect('admin/index');
            }   
            else
            {
                return redirect('/index');
            }
        }
    }
}