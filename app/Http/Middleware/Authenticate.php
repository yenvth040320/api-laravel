<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next)
    {
        if (! auth()->guard('api')->check()) {
            return  response()->json('ban hay dang nhap', 401);
        }else{
            return $next($request);
        }
    }
}
