<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\Application\search;

use AnimalSociety\Shared\Domain\Bus\Query\Query;

final class GetAssociationAnimalsQuery implements Query
{
    public function __construct(
        private readonly string $associationId,
    ) {}

    public function associationId(): string
    {
        return $this->associationId;
    }
}
