<?php

namespace App\Providers;


use \Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = ['App\Model' => 'App\Policies\ModelPolicy',];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $func = function ($user, $question)
        {
            // dd() function really help
            // dd($user->id == $question->user_id , $user , $question ) ;
            return $user->id == $question->user_id;
        } ;

        Gate::define( 'delete_question', $func);

        Gate::define('edit_question' , $func);


    }
}
