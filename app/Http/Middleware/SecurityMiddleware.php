<?php

namespace App\Http\Middleware;

use App\Utility\MyLogger2;
use Closure;

class SecurityMiddleware
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
        $path = $request->path();
        MyLogger2::info("Entering My Security MIddleware in handle() at path: ". $path);
        
        $secureCheck = true;
        if($request->is('/') ||
            $request->is('doLogin') ||
            $request->is('doLogin3') ||
            $request->is('doVal') ||
            $request->is('usersrest') ||
            $request->is('usersrest/1') ||
            $request->is('usersrest/3') ||
            $request->is('Login') ||
            $request->is('loggingservice')
            ){
            $secureCheck = false;
        }
        MyLogger2::info($secureCheck ? "Security Middleware is handle()...Security Needed" :
                                          "Security Middleware is handle()...No Security Required");
        
        $enable = true;
        if($enable && $secureCheck)
        {
            MyLogger2::info("Leaving Security Middleware and redirecting bakc to login");
            return redirect('/Login');
        }
        return $next($request);
    }
}
