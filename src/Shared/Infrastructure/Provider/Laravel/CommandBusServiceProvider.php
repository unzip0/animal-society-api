<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Provider\Laravel;

use AnimalSociety\Administration\Animals\AnimalsRaces\Application\create\CreateAnimalRaceCommand;
use AnimalSociety\Administration\Animals\AnimalsRaces\Application\create\CreateAnimalRaceCommandHandler;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Application\create\CreateAnimalSpeciesCommand;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Application\create\CreateAnimalSpeciesCommandHandler;
use AnimalSociety\Administration\Animals\Application\create\CreateAnimalCommand;
use AnimalSociety\Administration\Animals\Application\create\CreateAnimalCommandHandler;
use AnimalSociety\Administration\Animals\Application\delete\DeleteAnimalCommand;
use AnimalSociety\Administration\Animals\Application\delete\DeleteAnimalCommandHandler;
use AnimalSociety\Administration\Animals\Application\update\UpdateAnimalCommand;
use AnimalSociety\Administration\Animals\Application\update\UpdateAnimalCommandHandler;
use AnimalSociety\Administration\Associations\Application\create\CreateAssociationCommand;
use AnimalSociety\Administration\Associations\Application\create\CreateAssociationCommandHandler;
use AnimalSociety\Administration\Users\Application\register\RegisterUserCommand;
use AnimalSociety\Administration\Users\Application\register\RegisterUserCommandHandler;
use AnimalSociety\Administration\Users\Application\update\UpdateUserCommand;
use AnimalSociety\Administration\Users\Application\update\UpdateUserCommandHandler;
use AnimalSociety\Shared\Domain\Bus\Command\CommandBus;
use Illuminate\Support\ServiceProvider;

class CommandBusServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $commandBus = $this->app->make(CommandBus::class);
        $commandBus->register($this->commandBindings());
    }

    /**
     * @return array<string,string>
     */
    private function commandBindings(): array
    {
        return array_merge(
            $this->associationCommandBindings(),
            $this->userCommandBindings(),
            $this->animalCommandBindings()
        );
    }

    /**
     * @return array<string,string>
     */
    private function associationCommandBindings(): array
    {
        return [
            CreateAssociationCommand::class => CreateAssociationCommandHandler::class,
        ];
    }

    /**
     * @return array<string,string>
     */
    private function userCommandBindings(): array
    {
        return [
            RegisterUserCommand::class => RegisterUserCommandHandler::class,
            UpdateUserCommand::class => UpdateUserCommandHandler::class,
        ];
    }

    /**
     * @return array<string,string>
     */
    private function animalCommandBindings(): array
    {
        return [
            CreateAnimalSpeciesCommand::class => CreateAnimalSpeciesCommandHandler::class,
            CreateAnimalRaceCommand::class => CreateAnimalRaceCommandHandler::class,
            CreateAnimalCommand::class => CreateAnimalCommandHandler::class,
            UpdateAnimalCommand::class => UpdateAnimalCommandHandler::class,
            DeleteAnimalCommand::class => DeleteAnimalCommandHandler::class,
        ];
    }
}
