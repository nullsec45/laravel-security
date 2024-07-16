<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Providers\Guard\TokenGuard;
use Illuminate\Foundation\Application;
use App\Providers\User\SimpleUserProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\{User, Contact, Todo};
use Illuminate\Auth\Access\Response;
use App\Policies\TodoPolicy;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Todo::class => TodoPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Auth::extend("token", function (Application $app, string $name, array $config) {
            $tokenGuard = new TokenGuard(Auth::createUserProvider($config["provider"]), $app->make(Request::class));
            $app->refresh("request", $tokenGuard, "setRequest");
            return $tokenGuard;
        });

        Auth::provider("simple-user-provider", function(Application $app, array $config){
            return new SimpleUserProvider();
        });

        Gate::define("get-contact", function(User $user, Contact $contact){
            return $user->id == $contact->user_id;
        });

        Gate::define("update-contact", function(User $user, Contact $contact){
            return $user->id == $contact->user_id;
        });

        Gate::define("delete-contact", function(User $user){
            if($user->name == "admin"){
                return Response::allow();
            }else{
                return Response::deny("You are not admin!");
            }
        });
    }
}
