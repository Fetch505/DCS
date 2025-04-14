<?php

namespace App\Providers;

use Gate;
use Blade;
use App\Models\Permission;
use Illuminate\Support\ServiceProvider;

class PermissionsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // check whether the currently authenticated user has this permission
        try {
            Permission::get()->map(function ($permission) {
                Gate::define($permission->name, function($user) use ($permission) {
                    return $user->hasPermissionTo($permission);
                });
            });

        } catch (\Exception $e) {
                return [];
        }


        Blade::if('role', function($role) {
            return auth()->check() && auth()->user()->hasRole($role);
        });

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
