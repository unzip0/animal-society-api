<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Associations\Application\findAll;

use AnimalSociety\Administration\Associations\Application\findAll\FindAllAssociationsQuery;

final class FindAllAssociationsQueryMother
{
    public static function create(): FindAllAssociationsQuery
    {
        return new FindAllAssociationsQuery();
    }
}
