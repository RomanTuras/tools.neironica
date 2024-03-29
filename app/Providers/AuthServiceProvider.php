<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

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

        Passport::routes();

        // define admin role
        Gate::define('isAdmin', function($user) {
            return $user->role == 'admin';
        });

        // define teacher role
        Gate::define('isTeacher', function($user) {
            return $user->role == 'teacher';
        });

        // define student role
        Gate::define('isStudent', function($user) {
            return $user->role == 'student';
        });
    }
}
