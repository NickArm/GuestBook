<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PropertyGuideController;
use App\Http\Controllers\PropertyServiceController;

class CheckRole
{

    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            // If user is not logged in, redirect to the login page
            return redirect('login');
        }

        if (!in_array(auth()->user()->role, $roles)) {
            // Redirect based on role if they don't match the expected roles for a route
            if (auth()->user()->role == 'admin') {
                return redirect('/admin/dashboard');
            } elseif (auth()->user()->role == 'owner') {
                return redirect('/owner/dashboard');
            }
            
            // Redirect to a default location or show error if the role doesn't match any known dashboard
            return redirect('/login')->with('error', 'Unauthorized');
        }
        
        return $next($request);
    }

}
