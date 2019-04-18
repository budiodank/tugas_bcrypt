<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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

        Gate::define('manage-users', function($user){
            return $user->name == 'Admin';
        });

        Gate::define('manage-clients', function($user){
            return $user->name == 'Admin';
        });

        Gate::define('manage-areas', function($user){
            return $user->name == 'Admin' OR $user->name == 'Odank';
        });

        Gate::define('manage-accounts', function($user){
            return $user->name == 'Admin';
        });

        Gate::define('manage-packets', function($user){
            return $user->name == 'Admin';
        });

        Gate::define('manage-payments', function($user){
            return $user->name == 'Admin';
        });
    }
}
