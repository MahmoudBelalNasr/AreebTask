<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Task;
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
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
{
    Gate::define('list-own-childs', fn($user) => $user->isManager());
    Gate::define('create-own-childs', fn($user) => $user->isManager());
    Gate::define('update-own-childs', fn($user, $child) => $user->id === $child->manager_id);
    Gate::define('delete-own-childs', fn($user, $child) => $user->id === $child->manager_id);

    Gate::define('list-department', fn($user) => true);
    Gate::define('create-department', fn($user) => $user->isManager());
    Gate::define('update-department', fn($user) => $user->isManager());
    Gate::define('delete-department', fn($user) => $user->isManager());

    Gate::define('list-tasks', fn($user) => true);
    Gate::define('create-tasks', fn($user) => $user->isManager());
    Gate::define('update-tasks', fn($user) => $user->isManager());
    Gate::define('update-own-tasks', fn($user, $task) => $user->id === $task->user_id);
}
}
