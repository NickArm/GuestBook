<?php

namespace App\Providers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('inc.header', function ($view) {
            $view->with('owner', Auth::user());
        });
        
        // Share data with the inc.sidebar view
        view()->composer('inc.sidebar', function ($view) {
            // Fetch the authenticated user
            $user = auth()->user();

            // Check if a user is authenticated
            if ($user) {
                // Fetch all user properties
                $properties = $user->properties()->get();
            } else {
                $properties = collect(); // Empty collection if no user is authenticated
            }

            // Share the properties with the inc.sidebar view
            $view->with('properties', $properties);
        });
    }
}
