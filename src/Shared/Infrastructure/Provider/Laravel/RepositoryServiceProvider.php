<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Provider\Laravel;

use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\AnimalRaceRepository;
use AnimalSociety\Administration\Animals\AnimalsRaces\Infrastructure\Persistence\EloquentAdministrationAnimalRaceRepository;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpeciesRepository;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Infrastructure\Persistence\EloquentAdministrationAnimalSpeciesRepository;
use AnimalSociety\Administration\Animals\Domain\AnimalRepository;
use AnimalSociety\Administration\Animals\Infrastructure\Persistence\EloquentAdministrationAnimalRepository;
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
            AnimalSpeciesRepository::class => EloquentAdministrationAnimalSpeciesRepository::class,
            AnimalRaceRepository::class => EloquentAdministrationAnimalRaceRepository::class,
            AnimalRepository::class => EloquentAdministrationAnimalRepository::class,
        ];
    }
}
