<?php

declare(strict_types=1);

namespace App\Providers;

use AnimalSociety\Shared\Infrastructure\Provider\Laravel\CommandBusServiceProvider;
use AnimalSociety\Shared\Infrastructure\Provider\Laravel\InternalEventBusServiceProvider;
use AnimalSociety\Shared\Infrastructure\Provider\Laravel\NotificationServiceProvider;
use AnimalSociety\Shared\Infrastructure\Provider\Laravel\QueryBusServiceProvider;
use AnimalSociety\Shared\Infrastructure\Provider\Laravel\RepositoryServiceProvider;
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
        $this->app->register(NotificationServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {}
}
