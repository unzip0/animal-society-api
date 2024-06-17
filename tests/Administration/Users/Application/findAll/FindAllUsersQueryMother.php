<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Users\Application\findAll;

use AnimalSociety\Administration\Users\Application\findAll\FindAllUsersQuery;

final class FindAllUsersQueryMother
{
    public static function create(string $associationId): FindAllUsersQuery
    {
        return new FindAllUsersQuery($associationId);
    }
}
