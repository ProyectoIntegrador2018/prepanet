<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\Users\StudioAdministrator;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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

        Gate::define('is-super', function ($user) {
            $userable = $user->userable;
            return $userable instanceof SuperAdministrator;
        });
    }
}
