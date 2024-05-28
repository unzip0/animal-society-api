<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Provider\Laravel;

use AnimalSociety\Administration\Associations\Domain\AssociationRepository;
use AnimalSociety\Administration\Associations\Infrastructure\Persistence\EloquentAdministrationAssociationRepository;
use AnimalSociety\Administration\Users\Domain\UserRepository;
use AnimalSociety\Administration\Users\Infrastructure\Persistence\EloquentAdministrationUserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        foreach ($this->repositories() as $port => $adapter) {
            $this->app->bind($port, $adapter);
        }
    }

    /**
     * @return string[]
     */
    public function provides(): array
    {
        return array_keys($this->repositories());
    }

    /**
     * @return array<string,string>
     */
    private function repositories(): array
    {
        return [
            AssociationRepository::class => EloquentAdministrationAssociationRepository::class,
            UserRepository::class => EloquentAdministrationUserRepository::class,
        ];
    }
}
