<?php

namespace App\Providers;

use App\Services\Contracts\CreateTaskSituationServiceContract;
use App\Services\CreateTaskSituationService;
use App\Services\Task\Contracts\CreateTaskServiceContract;
use App\Services\Task\CreateTaskService;
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
        $this->TaskBoot();
    }

    public function TaskSituationBoot() :void
    {
        $this->app->bind(CreateTaskSituationServiceContract::class, CreateTaskSituationService::class);
    }

    public function TaskBoot() :void
    {
        $this->app->bind(CreateTaskServiceContract::class, CreateTaskService::class);
    }
}
