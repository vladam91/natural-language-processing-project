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
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\TextPost' => 'App\Policies\TextPostPolicy',
        'App\VideoPost' => 'App\Policies\VideoPostPolicy',
        'App\TextPostComment' => 'App\Policies\TextPostCommentPolicy',
        'App\VideoPostComment' => 'App\Policies\VideoPostCommentPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
