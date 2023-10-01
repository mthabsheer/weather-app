<?php

namespace App\Providers;

use App\Contracts\CitiesRepositoryContract;
use App\Repositories\CitiesRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CitiesRepositoryContract::class, CitiesRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
