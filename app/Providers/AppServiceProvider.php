<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(RepositoryServiceProvider::class);
        $this->app->register(CommandBusServiceProvider::class);
        $this->app->register(QueryBusServiceProvider::class);
        $this->app->register(InternalEventBusServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {}
}
