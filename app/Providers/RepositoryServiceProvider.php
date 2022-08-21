<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\Master\MasterRepositoryInterface;
use App\Repository\Master\MasterRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MasterRepositoryInterface::class, MasterRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
