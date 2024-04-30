<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Bus;

use AnimalSociety\Shared\Domain\Bus\Query\Query;
use AnimalSociety\Shared\Domain\Bus\Query\QueryBus;
use AnimalSociety\Shared\Domain\Bus\Query\Response;
use Illuminate\Bus\Dispatcher;

class IlluminateQueryBus implements QueryBus
{
    public function __construct(
        protected Dispatcher $bus,
    ) {}

    public function ask(Query $query): ?Response
    {
        return $this->bus->dispatch($query);
    }

    /**
     * @param array<string,string> $map
     */
    public function register(array $map): void
    {
        $this->bus->map($map);
    }
}
