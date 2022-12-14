<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('profile-edit', function($user, $profile){
            if (!Auth::user()->isAdmin()){
                return $user->id == $profile->id;
            } else {
                return $user->id;
            }
        });

        Gate::define('member-portal', function($user){
            return $user->isMembership;
        });
    }
}
