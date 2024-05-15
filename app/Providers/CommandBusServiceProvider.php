<?php

declare(strict_types=1);

namespace App\Providers;

use AnimalSociety\Administration\Associations\Application\create\CreateAssociationCommand;
use AnimalSociety\Administration\Associations\Application\create\CreateAssociationCommandHandler;
use AnimalSociety\Administration\Users\Application\register\RegisterUserCommand;
use AnimalSociety\Administration\Users\Application\register\RegisterUserCommandHandler;
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
        ];
    }
}
