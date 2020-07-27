<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
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
        $isLogin =session('isAdminLogin',False);
        if(($isLogin===True)||(env('AdminPass')===$request->get('pass')))
            return $next($request);
        else
            return StandardJsonResponse(-1,"Admin pass wrong");

    }
}
