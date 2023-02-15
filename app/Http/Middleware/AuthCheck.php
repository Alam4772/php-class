<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class AuthCheck
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()) {

            return $next($request);
        }

        if($request->ajax()) {

            return response(['message' => 'Unauthorised', 'redirect' => 'user/login'], 400);
        }

        return redirect('user/login');
    }
}
