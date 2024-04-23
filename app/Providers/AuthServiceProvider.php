<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
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

        Gate::define('is_superadmin',function (User $user){
            return $user->role == 1;
        });
        Gate::define('is_miniadmin',function (User $user){
            return $user->role == 1 || $user->role==2 || $user->role==3 || $user->role==4;
        });
        Gate::define('is_ostani_admin',function (User $user){
           return $user->role==2;
        });
        Gate::define('is_masjed_admin',function (User $user){
            return $user->role==3;
        });
        Gate::define('is_shahrestan_admin',function (User $user){
            return $user->role==4;
        });
        Gate::define('is_participant',function (User $user){
            return $user->role == 0;
        });
        /*Gate::define('can_participate_azmoon',function (User $user){

        });*/
    }
}
