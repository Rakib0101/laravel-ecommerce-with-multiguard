<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

use function PHPUnit\Framework\returnSelf;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {

            if ($request->routeIs('admin.*')) {

                if($request->status) {
                    if (Auth::guard('admin')->check()){
                        if (auth()->check()) {
                            return '/admin/home';
                        } else {
                            return '/admin/login';
                        }
                    }
                    else{
                        return '/admin/login';
                    }        
                }else{
                    return '/admin/login';
                }
            }
            if ($request->routeIs('user.*')) {

                if($request->status) {
                    if (Auth::guard('web')->check()){
                        if (auth()->check()) {
                            return '/user/home';
                        } else {
                            return '/user/login';
                        }
                    }
                    else{
                        return '/user/login';
                    }       
                }else{
                    return '/user/login';
                }
            }

        }
    }
}
