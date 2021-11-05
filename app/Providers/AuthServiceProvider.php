<?php

namespace App\Providers;
use App\Policies\UserPolicy;
use App\Policies\ProductPolicy;

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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->defineGateThere();
        $this->defineGateTwo();
        Gate::define('all-user', [UserPolicy::class, 'view']);
        
    }
    public function defineGateThere(){
        Gate::define('three-auth', [UserPolicy::class, 'viewAny']);
    }
    public function defineGateTwo(){
        Gate::define('two-auth', [UserPolicy::class, 'viewTwo']);
    }
}
