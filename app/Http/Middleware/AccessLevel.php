<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AccessLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     

    public function handle($request, Closure $next)
    {
        if(Auth::user()->hasRole('administrator')){
         return $next($request);   
        }
        return redirect('home');
    }
    */


    public function handle($request, Closure $next, ...$role)
    {
        if(Auth::user()->hasRole($role)){
         return $next($request);   
        }
        return redirect('home');
    }
}
