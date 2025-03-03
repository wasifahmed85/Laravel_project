<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(Auth::check()){
            if (Auth::user()->utype === 'ADM') {
                return $next($request); // Allow if the user is an admin
            }
            else{
                Session::flush();
                return redirect()->route('login'); // Redirect to login if not an admin
            }
        }
        else{
            return redirect()->route('login'); // Redirect to login if not an admin
        }
        // if (Auth::check() && Auth::user()->utype === 'ADM') {
        //     return $next($request); // Allow if the user is an admin
        // }

        // return redirect()->route('login'); // Redirect to login if not an admin
    }
}
