<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Animals\AnimalRaces\Domain;

use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\AnimalRaceId;
use AnimalSociety\Tests\Shared\Domain\UuidMother;

final class AnimalRaceIdMother
{
    public static function create(?string $value = null): AnimalRaceId
    {
        return new AnimalRaceId($value ?? UuidMother::create());
    }
}
