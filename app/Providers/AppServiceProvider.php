<?php

declare(strict_types=1);

namespace App\Providers;

use AnimalSociety\Administration\Associations\Application\create\CreateAssociationCommand;
use AnimalSociety\Administration\Associations\Application\create\CreateAssociationCommandHandler;
use AnimalSociety\Administration\Associations\Application\findAll\FindAllAssociationsQuery;
use AnimalSociety\Administration\Associations\Application\findAll\FindAllAssociationsQueryHandler;
use AnimalSociety\Administration\Associations\Domain\AssociationRepository;
use AnimalSociety\Administration\Associations\Infrastructure\Persistence\DoctrineAdministrationAssociationRepository;
use AnimalSociety\Administration\Users\Application\register\RegisterUserCommand;
use AnimalSociety\Administration\Users\Application\register\RegisterUserCommandHandler;
use AnimalSociety\Administration\Users\Domain\UserRepository;
use AnimalSociety\Administration\Users\Infrastructure\Persistence\DoctrineAdministrationUserRepository;
use AnimalSociety\Shared\Domain\Bus\Command\CommandBus;
use AnimalSociety\Shared\Domain\Bus\Query\QueryBus;
use AnimalSociety\Shared\Infrastructure\Bus\IlluminateCommandBus;
use AnimalSociety\Shared\Infrastructure\Bus\IlluminateQueryBus;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerSingletons();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->bootCommands();
        $this->bootQueries();
    }

    private function registerSingletons(): void
    {
        $singletons = array_merge([
            CommandBus::class => IlluminateCommandBus::class,
            QueryBus::class => IlluminateQueryBus::class,
        ], $this->repositories());

        foreach ($singletons as $abstract => $concrete) {
            $this->app->singleton(
                $abstract,
                $concrete
            );
        }
    }

    private function bootCommands(): void
    {
        $commandBus = $this->app->make(CommandBus::class);

        $commandBus->register([
            CreateAssociationCommand::class => CreateAssociationCommandHandler::class,
            RegisterUserCommand::class => RegisterUserCommandHandler::class,
        ]);
    }

    private function bootQueries(): void
    {
        $queryBus = $this->app->make(QueryBus::class);

        $queryBus->register([
            FindAllAssociationsQuery::class => FindAllAssociationsQueryHandler::class,
        ]);
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
