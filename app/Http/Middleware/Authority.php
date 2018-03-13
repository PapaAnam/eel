<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Authority as A;
class Authority
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
        // if(Auth::user()->level!=1){
        //     A::where('user', Auth::id())->
        //     return abort('404');
        // }
        return $next($request);
    }
}
