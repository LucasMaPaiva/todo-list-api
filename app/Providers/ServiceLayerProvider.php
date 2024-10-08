<?php

namespace App\Providers;

use App\Services\Auth\Contracts\GetUserbyEmailServiceContract;
use App\Services\Auth\Contracts\GetUserByIdServiceContract;
use App\Services\Auth\Contracts\LoginServiceContract;
use App\Services\Auth\Contracts\RegisterUserServiceContract;
use App\Services\Auth\GetUserbyEmailService;
use App\Services\Auth\GetUserByIdService;
use App\Services\Auth\LoginService;
use App\Services\Auth\RegisterUserService;
use App\Services\Contracts\CreateTaskSituationServiceContract;
use App\Services\CreateTaskSituationService;
use App\Services\Tag\Contracts\CreateTagServiceContract;
use App\Services\Tag\Contracts\DestroyTagServiceContract;
use App\Services\Tag\Contracts\GetTagByIdService;
use App\Services\Tag\Contracts\GetTagByIdServiceContract;
use App\Services\Tag\CreateTagService;
use App\Services\Tag\DestroyTagService;
use App\Services\Task\Contracts\CreateTaskServiceContract;
use App\Services\Task\Contracts\DeleteTaskServiceContract;
use App\Services\Task\Contracts\GetTaskByIdServiceContract;
use App\Services\Task\Contracts\ListTaskByUserServiceContract;
use App\Services\Task\Contracts\UpdateTaskServiceContract;
use App\Services\Task\CreateTaskService;
use App\Services\Task\DeleteTaskService;
use App\Services\Task\GetTaskByIdService;
use App\Services\Task\ListTaskByUserService;
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
        $this->TagBoot();
    }

    public function AuthBoot() :void
    {
        $this->app->bind(LoginServiceContract::class, LoginService::class);
        $this->app->bind(GetUserbyEmailServiceContract::class, GetUserbyEmailService::class);
        $this->app->bind(RegisterUserServiceContract::class, RegisterUserService::class);
        $this->app->bind(GetUserByIdServiceContract::class, GetUserByIdService::class);
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
        $this->app->bind(DeleteTaskServiceContract::class, DeleteTaskService::class);
        $this->app->bind(ListTaskByUserServiceContract::class, ListTaskByUserService::class);
    }

    public function TagBoot() :void
    {
        $this->app->bind(CreateTagServiceContract::class, CreateTagService::class);
        $this->app->bind(DestroyTagServiceContract::class, DestroyTagService::class);
        $this->app->bind(GetTagByIdServiceContract::class, GetTagByIdService::class);
    }
}
