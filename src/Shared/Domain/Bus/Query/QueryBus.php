<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Domain\Bus\Query;

interface QueryBus
{
    public function ask(Query $query): ?Response;

    /**
     * @param array<string,string> $map
     */
    public function register(array $map): void;
}
