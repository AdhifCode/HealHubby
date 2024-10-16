<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth; // Add this line to import the Auth facade
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        // $this->registerPolicies();

        // Auth::provider('socialite', function ($app, array $config) {
        //     return new EloquentUserProvider($app['hash'], $config['model']);
        // });
    }
}
