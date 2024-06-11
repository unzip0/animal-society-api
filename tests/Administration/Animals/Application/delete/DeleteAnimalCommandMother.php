<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Animals\Application\delete;

use AnimalSociety\Administration\Animals\Application\delete\DeleteAnimalCommand;
use AnimalSociety\Administration\Animals\Domain\AnimalId;
use AnimalSociety\Administration\Associations\Domain\AssociationId;
use AnimalSociety\Tests\Administration\Animals\Domain\AnimalIdMother;
use AnimalSociety\Tests\Administration\Associations\Domain\AssociationIdMother;

final class DeleteAnimalCommandMother
{
    public static function create(
        ?AnimalId $animalId = null,
        ?AssociationId $associationId = null,
    ): DeleteAnimalCommand {
        return new DeleteAnimalCommand(
            $animalId?->value() ?? AnimalIdMother::create()->value(),
            $associationId?->value() ?? AssociationIdMother::create()->value(),
        );
    }
}
