<?php

namespace App\Providers;

use App\Services\Contracts\CreateTaskSituationServiceContract;
use App\Services\CreateTaskSituationService;
use App\Services\Task\Contracts\CreateTaskServiceContract;
use App\Services\Task\Contracts\GetTaskByIdServiceContract;
use App\Services\Task\Contracts\UpdateTaskServiceContract;
use App\Services\Task\CreateTaskService;
use App\Services\Task\GetTaskByIdService;
use App\Services\Task\UpdateTaskService;
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
        $this->app->bind(UpdateTaskServiceContract::class, UpdateTaskService::class);
        $this->app->bind(GetTaskByIdServiceContract::class, GetTaskByIdService::class);
    }
}
