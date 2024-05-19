<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Provider\Laravel;

use AnimalSociety\Administration\Associations\Domain\AssociationRepository;
use AnimalSociety\Administration\Associations\Infrastructure\Persistence\DoctrineAdministrationAssociationRepository;
use AnimalSociety\Administration\Users\Domain\UserRepository;
use AnimalSociety\Administration\Users\Infrastructure\Persistence\DoctrineAdministrationUserRepository;
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
            AssociationRepository::class => DoctrineAdministrationAssociationRepository::class,
            UserRepository::class => DoctrineAdministrationUserRepository::class,
        ];
    }
}
