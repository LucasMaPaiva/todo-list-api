<?php

namespace App\Providers;

use App\Repository\Contracts\TaskSituationRepositoryContract;
use App\Repository\TaskSituationRepository;
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
        $this->TaskSituationBoot();
    }

    public function TaskSituationBoot() :void
    {
        $this->app->bind(TaskSituationRepositoryContract::class, TaskSituationRepository::class);
    }
}
