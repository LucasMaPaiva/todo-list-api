<?php

namespace App\Providers;

use App\Services\Contracts\CreateTaskSituationServiceContract;
use App\Services\CreateTaskSituationService;
use Illuminate\Support\ServiceProvider;

class ServiceLayerProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->TaskSituationBoot();
    }

    public function TaskSituationBoot() :void
    {
        $this->app->bind(CreateTaskSituationServiceContract::class, CreateTaskSituationService::class);
    }
}
