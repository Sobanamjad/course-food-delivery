<?php

namespace App\Providers;

use App\Models\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    // ...

    public function boot(): void
    {
        $this->registerPolicies();

        // Gate::before(function ($user, $ability) {
        //     // Only allow if the Gate is defined or permission exists
        //     if (Permission::where('name', $ability)->exists() && $user->hasPermission($ability)) {
        //         return true;
        //     }
        // });

        $this->registerGates();
    }

    protected function registerGates(): void
    {
        try {
            foreach (Permission::pluck('name') as $permission) {
                Gate::define($permission, function ($user) use ($permission) {
                    return $user->hasPermission($permission);
                });
            }
        } catch (\Exception $e) {
            info('registerPermissions(): Database not found or not yet migrated. Ignoring user permissions while booting app.');
        }
    }
}
