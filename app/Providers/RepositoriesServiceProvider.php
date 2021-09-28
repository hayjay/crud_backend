<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\{TodoRepository, TodoStatusRepository};
use App\Interfaces\{TodoRepositoryInterface, TodoStatusRepositoryInterface};

class RepositoriesServiceProvider extends ServiceProvider
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
        $this->app->bind(TodoRepositoryInterface::class, TodoRepository::class);
        $this->app->bind(TodoStatusRepositoryInterface::class, TodoStatusRepository::class);
    }
}
