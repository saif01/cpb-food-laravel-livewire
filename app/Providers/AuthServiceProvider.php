<?php

namespace App\Providers;

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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //Define Gates
        Gate::define('manageUser', function($user){
            return $user->hasAnyRoles(['Administrator', 'Admin']);
        });

        Gate::define('delete', function($user){
            return $user->hasAnyRoles(['Administrator', 'Delete']);
        });

        Gate::define('roleManage', function($user){
            return $user->hasRole(['Administrator']);
        });

        //Add Access
        Gate::define('creator', function($user){
            return $user->hasAnyRoles(['Administrator', 'Author']);
        });

        Gate::define('publisher', function($user){
            return $user->hasAnyRoles(['Administrator', 'Publisher']);
        });

        //Post Section
        Gate::define('post', function($user){
            return $user->hasAnyRoles(['Administrator', 'Admin', 'Post-section']);
        });

        //Product-section
        Gate::define('product', function($user){
            return $user->hasAnyRoles(['Administrator', 'Admin', 'Product-section']);
        });

        //Promotion-section
        Gate::define('promotion', function($user){
            return $user->hasAnyRoles(['Administrator', 'Admin', 'Promotion-section']);
        });

        //About-section
        Gate::define('about', function($user){
            return $user->hasAnyRoles(['Administrator', 'Admin', 'About-section']);
        });

        //About-section
        Gate::define('contact', function($user){
            return $user->hasAnyRoles(['Administrator', 'Admin', 'Contact-section']);
        });







    }
}
