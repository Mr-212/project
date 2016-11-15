<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $type=Auth::user()->type;
       // dd($type);
        if ($type=='Admin') {
            return $next($request);

        }else{
            flash()->error("UnAuthorize Access");
            return redirect()->back();
        }

        return $next($request);
    }
}
