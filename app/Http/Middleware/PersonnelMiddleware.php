<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonnelMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || !Auth::user()->isPersonnel()) {
            return redirect()->route('login')->with('error', 'Vous n\'avez pas accès à cette page.');
        }

        return $next($request);
    }
}