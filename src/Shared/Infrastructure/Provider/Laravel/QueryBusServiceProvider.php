<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Provider\Laravel;

use AnimalSociety\Administration\Animals\Application\search\GetAssociationAnimalsQuery;
use AnimalSociety\Administration\Animals\Application\search\GetAssociationAnimalsQueryHandler;
use AnimalSociety\Administration\Associations\Application\findAll\FindAllAssociationsQuery;
use AnimalSociety\Administration\Associations\Application\findAll\FindAllAssociationsQueryHandler;
use AnimalSociety\Administration\Users\Application\login\LoginUserQuery;
use AnimalSociety\Administration\Users\Application\login\LoginUserQueryHandler;
use AnimalSociety\Shared\Domain\Bus\Query\QueryBus;
use Illuminate\Support\ServiceProvider;

class QueryBusServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $commandBus = $this->app->make(QueryBus::class);
        $commandBus->register($this->queryBindings());
    }

    /**
     * @return array<string,string>
     */
    private function queryBindings(): array
    {
        return [
            FindAllAssociationsQuery::class => FindAllAssociationsQueryHandler::class,
            LoginUserQuery::class => LoginUserQueryHandler::class,
            GetAssociationAnimalsQuery::class => GetAssociationAnimalsQueryHandler::class,
        ];
    }
}
