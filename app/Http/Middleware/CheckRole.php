<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;


class CheckRole
{

    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            // If user is not logged in, redirect to the login page
            return redirect('login');
        }

        if (!in_array(auth()->user()->role, $roles)) {
            // If user does not have the right role, redirect to the login page
            return redirect('login');
        }
        
        return $next($request);
    }
}
