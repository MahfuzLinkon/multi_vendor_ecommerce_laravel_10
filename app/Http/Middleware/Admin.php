<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('admin')->check()){
            return redirect('/admin/login');
        }
//        TODO ------------------
//        if (Auth::guard('admin')->check() && ($request->url() == 'http://127.0.0.1:8000/admin/login')){
//            return back();
//        }
        return $next($request)->header('cache-control', 'no-cache, no-store, max-age=0, must-revalidate');
    }
}
