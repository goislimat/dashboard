<?php

namespace Dashboard\Providers;

use Dashboard\Repositories\ClientRepository;
use Dashboard\Repositories\ClientRepositoryEloquent;
use Dashboard\Repositories\ProjectRepository;
use Dashboard\Repositories\ProjectRepositoryEloquent;
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
            ClientRepository::class,
            ClientRepositoryEloquent::class
        );
        
        $this->app->bind(
            ProjectRepository::class,
            ProjectRepositoryEloquent::class
        );
    }
}
