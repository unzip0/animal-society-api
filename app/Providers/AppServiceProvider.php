<?php

declare(strict_types=1);

namespace App\Providers;

use AnimalSociety\Shared\Infrastructure\Provider\Laravel\CommandBusServiceProvider;
use AnimalSociety\Shared\Infrastructure\Provider\Laravel\InternalEventBusServiceProvider;
use AnimalSociety\Shared\Infrastructure\Provider\Laravel\NotificationServiceProvider;
use AnimalSociety\Shared\Infrastructure\Provider\Laravel\QueryBusServiceProvider;
use AnimalSociety\Shared\Infrastructure\Provider\Laravel\RelationServiceProvider;
use AnimalSociety\Shared\Infrastructure\Provider\Laravel\RepositoryServiceProvider;
use AnimalSociety\Shared\Infrastructure\Provider\Laravel\StorageServiceProvider;
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
        $this->app->register(StorageServiceProvider::class);
        $this->app->register(RelationServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {}
}
