<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Associations\Domain;

use AnimalSociety\Administration\Associations\Application\AssociationResponse;
use AnimalSociety\Administration\Associations\Application\AssociationsResponse;
use AnimalSociety\Administration\Associations\Domain\Association;

final class AssociationsResponseMother
{
    public static function create(?Association $association): AssociationsResponse
    {
        if ($association === null) {
            return new AssociationsResponse();
        }

        return new AssociationsResponse(
            new AssociationResponse(
                $association->id()->__toString(),
                $association->associationCif()->value(),
                $association->associationName()->value(),
                $association->associationEmail()->value(),
                $association->associationCityId()->value()
            )
        );
    }
}
