<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Provider\Laravel;

use AnimalSociety\Shared\Domain\Jwt\JwtManagerContract;
use AnimalSociety\Shared\Infrastructure\Jwt\JwtManager;
use Illuminate\Support\ServiceProvider;

class AuthenticationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function boot(): void
    {
        $this->app->bind(JwtManagerContract::class, JwtManager::class);
    }
}
