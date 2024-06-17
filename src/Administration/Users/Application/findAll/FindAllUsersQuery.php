<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Application\findAll;

use AnimalSociety\Shared\Domain\Bus\Query\Query;

final class FindAllUsersQuery implements Query
{
    public function __construct(
        private readonly string $associationId,
    ) {}

    public function associationId(): string
    {
        return $this->associationId;
    }
}
