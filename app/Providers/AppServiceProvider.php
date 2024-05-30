<?php

namespace App\Providers;

use App\Models\City;
use App\Models\Role;
use App\Models\User;
use App\Models\Country;
use App\Models\Permission;
use App\Policies\CityPolicy;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use App\Policies\CountryPolicy;
use App\Policies\PermissionPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
        Gate::policy(Permission::class, PermissionPolicy::class);
        Gate::policy(Role::class, RolePolicy::class);
        Gate::policy(Country::class, CountryPolicy::class);
        Gate::policy(City::class, CityPolicy::class);
        Gate::policy(User::class, UserPolicy::class);

        
        Gate::define('browse_admin', fn(User $user) => $user->hasPermission('browse_admin'));
        Gate::define('administrator', fn(User $user) => $user->hasPermission('administrator'));
        Gate::define('banned', fn(User $user) => $user->hasPermission('banned'));
    
    }
}
