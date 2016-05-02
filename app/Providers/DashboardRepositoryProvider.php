<?php

namespace Dashboard\Providers;

use Illuminate\Support\ServiceProvider;

class DashboardRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \Dashboard\Repositories\ClientRepository::class,
            \Dashboard\Repositories\ClientRepositoryEloquent::class
        );
        
        $this->app->bind(
            \Dashboard\Repositories\ProjectRepository::class,
            \Dashboard\Repositories\ProjectRepositoryEloquent::class
        );
        
        $this->app->bind(
            \Dashboard\Repositories\ProjectNoteRepository::class,
            \Dashboard\Repositories\ProjectNoteRepositoryEloquent::class
        );
    }
}
