<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Animals\AnimalSpecies\Domain;

use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpeciesId;
use AnimalSociety\Tests\Shared\Domain\UuidMother;

final class AnimalSpeciesIdMother
{
    public static function create(?string $value = null): AnimalSpeciesId
    {
        return new AnimalSpeciesId($value ?? UuidMother::create());
    }
}
