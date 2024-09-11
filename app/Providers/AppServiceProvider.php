<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::morphMap([]);

        if (config('app.debug') === true && config('logging.query.debug')) {
            DB::listen(function ($query) {
                File::append(
                    storage_path('logs/query.log'),
                    $query->sql . ' [' . implode(' ,', $query->bindings) . '] ' . PHP_EOL
                );
            });
        }
    }
}
