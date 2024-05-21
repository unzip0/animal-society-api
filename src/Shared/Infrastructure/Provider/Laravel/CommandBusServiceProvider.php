<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Provider\Laravel;

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
        return [
            CreateAssociationCommand::class => CreateAssociationCommandHandler::class,
            RegisterUserCommand::class => RegisterUserCommandHandler::class,
            UpdateUserCommand::class => UpdateUserCommandHandler::class,
        ];
    }
}
