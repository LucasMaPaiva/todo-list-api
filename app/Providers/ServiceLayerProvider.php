<?php

namespace App\Providers;

use App\Services\Auth\Contracts\GetUserbyNameServiceContract;
use App\Services\Auth\Contracts\LoginServiceContract;
use App\Services\Auth\Contracts\SetDataInCacheServiceContracts;
use App\Services\Auth\Contracts\SetDataUserInCacheServiceContract;
use App\Services\Auth\GetUserbyNameService;
use App\Services\Auth\LoginService;
use App\Services\Auth\SetDataInCacheService;
use App\Services\Auth\setDataUserInCacheService;
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
        $this->AuthBoot();
        $this->TaskSituationBoot();
        $this->TaskBoot();
    }

    public function AuthBoot() :void
    {
        $this->app->bind(LoginServiceContract::class, LoginService::class);
        $this->app->bind(GetUserbyNameServiceContract::class, GetUserbyNameService::class);
        $this->app->bind(SetDataInCacheServiceContracts::class, SetDataInCacheService::class);
        $this->app->bind(SetDataUserInCacheServiceContract::class, SetDataUserInCacheService::class);
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
