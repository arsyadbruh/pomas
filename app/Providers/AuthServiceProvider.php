<?php

namespace App\Providers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        Gate::define('owner', function(User $user, Project $project){
            return $user->projectRole('owner', $project->id, $user->id);
        });

        Gate::define('member', function(User $user, Project $project){
            return $user->projectRole('member', $project->id, $user->id);
        });

        Gate::define('admin', function(User $user, Project $project){
            return $user->projectRole('admin', $project->id, $user->id);
        });
    }
}
