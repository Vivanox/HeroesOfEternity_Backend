<?php

namespace App\Providers;

use App\AlphaKey;
use App\AlphaSignUp;
use App\Policies\AlphaKeyPolicy;
use App\Policies\AlphaSignUpPolicy;
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
        AlphaSignUp::class => AlphaSignUpPolicy::class,
        AlphaKey::class => AlphaKeyPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
