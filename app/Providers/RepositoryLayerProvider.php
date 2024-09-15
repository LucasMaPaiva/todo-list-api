<?php

namespace App\Providers;

use App\Repository\Contracts\TaskRepositoryContract;
use App\Repository\Contracts\TaskSituationRepositoryContract;
use App\Repository\Contracts\UserRepositoryContract;
use App\Repository\TaskRepository;
use App\Repository\TaskSituationRepository;
use App\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryLayerProvider extends ServiceProvider {
    /**
     * Register services.
     */
    public function register(): void {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void {
        $this->UserBoot();
        $this->TaskSituationBoot();
        $this->TaskBoot();
    }

    public function UserBoot() :void
    {
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
    }

    public function TaskSituationBoot() :void
    {
        $this->app->bind(TaskSituationRepositoryContract::class, TaskSituationRepository::class);
    }

    public function TaskBoot() :void
    {
        $this->app->bind(TaskRepositoryContract::class, TaskRepository::class);
    }
}
