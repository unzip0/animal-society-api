<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Associations\Domain;

use AnimalSociety\Administration\Associations\Domain\Association;
use AnimalSociety\Administration\Associations\Domain\AssociationCreatedDomainEvent;

final class AssociationCreatedDomainEventMother
{
    public static function create(
        ?Association $association = null,
    ): AssociationCreatedDomainEvent {
        $association = $association ?? AssociationMother::create();
        return new AssociationCreatedDomainEvent(
            $association->id()->value(),
            $association,
        );
    }

    public static function fromAssociation(Association $association): AssociationCreatedDomainEvent
    {
        return self::create(
            $association,
        );
    }
}
