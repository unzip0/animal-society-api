<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Animals\Application\search;

use AnimalSociety\Administration\Animals\Application\search\GetAssociationAnimalsQuery;
use AnimalSociety\Administration\Associations\Domain\AssociationId;
use AnimalSociety\Tests\Administration\Associations\Domain\AssociationIdMother;

final class GetAssociationAnimalsQueryMother
{
    public static function create(
        ?AssociationId $associationId = null,
    ): GetAssociationAnimalsQuery {
        return new GetAssociationAnimalsQuery(
            $associationId?->value() ?? AssociationIdMother::create()->value(),
        );
    }
}
