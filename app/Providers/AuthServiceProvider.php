<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('edit', function($user){
            return $user->hasAnyRoles(['Admin','Manager']);
        });
        Gate::define('delete', function($user){
            return $user->hasAnyRoles(['Admin','Manager']);
        });
        Gate::define('create', function($user){
            return $user->hasAnyRoles(['Admin','Manager']);
        });
        Gate::define('update-password', function($user){
            return $user->hasAnyRoles(['Admin','Manager']);
        });

        //
    }
}
