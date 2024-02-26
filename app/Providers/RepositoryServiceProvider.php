<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('App\Http\Interfaces\UserInterface', 'App\Http\Repositories\UserRepository');
        $this->app->bind('App\Http\Interfaces\DepartmentInterface', 'App\Http\Repositories\DepartmentRepository');
    }
}
