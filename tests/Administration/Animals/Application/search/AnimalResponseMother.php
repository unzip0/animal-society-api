<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Animals\Application\search;

use AnimalSociety\Administration\Animals\Application\AnimalResponse;
use AnimalSociety\Tests\Administration\Animals\AnimalRaces\Domain\AnimalRaceIdMother;
use AnimalSociety\Tests\Administration\Animals\AnimalSpecies\Domain\AnimalSpeciesIdMother;
use AnimalSociety\Tests\Administration\Animals\Domain\AnimalAgeMother;
use AnimalSociety\Tests\Administration\Animals\Domain\AnimalIdMother;
use AnimalSociety\Tests\Administration\Animals\Domain\AnimalNameMother;

final class AnimalResponseMother
{
    public static function create(
        ?string $id = null,
        ?string $name = null,
        ?string $speciesId = null,
        ?string $raceId = null,
        ?int $age = null,
        ?bool $available = null,
    ): AnimalResponse {
        return new AnimalResponse(
            $id ?? AnimalIdMother::create()->value(),
            $name ?? AnimalNameMother::create()->value(),
            $speciesId ?? AnimalSpeciesIdMother::create()->value(),
            $raceId ?? AnimalRaceIdMother::create()->value(),
            $age ?? AnimalAgeMother::create()->value(),
            $available ?? true
        );
    }
}
