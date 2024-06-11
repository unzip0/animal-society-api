<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Animals\Application\update;

use AnimalSociety\Administration\Animals\Application\update\UpdateAnimalCommand;
use AnimalSociety\Tests\Administration\Animals\AnimalRaces\Domain\AnimalRaceIdMother;
use AnimalSociety\Tests\Administration\Animals\AnimalSpecies\Domain\AnimalSpeciesIdMother;
use AnimalSociety\Tests\Administration\Animals\Domain\AnimalAgeMother;
use AnimalSociety\Tests\Administration\Animals\Domain\AnimalIdMother;
use AnimalSociety\Tests\Administration\Animals\Domain\AnimalNameMother;
use AnimalSociety\Tests\Administration\Associations\Domain\AssociationIdMother;

final class UpdateAnimalCommandMother
{
    public static function create(
        ?string $id = null,
        ?string $associationId = null,
        ?string $name = null,
        ?string $speciesId = null,
        ?string $raceId = null,
        ?int $age = null,
        ?string $photoPath = null,
        ?string $photoName = null,
        ?string $photoMimeType = null,
        ?string $photoExtension = null,
    ): UpdateAnimalCommand {
        return new UpdateAnimalCommand(
            $id ?? AnimalIdMother::create()->value(),
            $associationId ?? AssociationIdMother::create()->value(),
            $name ?? AnimalNameMother::create()->value(),
            $speciesId ?? AnimalSpeciesIdMother::create()->value(),
            $raceId ?? AnimalRaceIdMother::create()->value(),
            $age ?? AnimalAgeMother::create()->value(),
            $photoPath,
            $photoName,
            $photoMimeType,
            $photoExtension
        );
    }
}
