<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Session;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Redirect authenticated users to their dashboard
        RedirectIfAuthenticated::redirectUsing(function (Request $request) {
            if ($request->is('admin/*')) {
                return route('admin.admin-dashboard');
            }
            return route('user.dashboard');
        });

        // Redirect unauthenticated users to login
        Authenticate::redirectUsing(function (Request $request) {
            Session::flash('fail', 'Please login to continue');
            
            if ($request->is('admin/*')) {
                return route('admin.login');
            }
            return route('user.login');
        });
    
    }
}
