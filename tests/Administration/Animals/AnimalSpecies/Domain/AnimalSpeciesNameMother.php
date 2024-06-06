<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Animals\AnimalSpecies\Domain;

use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpeciesName;
use AnimalSociety\Tests\Shared\Domain\WordMother;

final class AnimalSpeciesNameMother
{
    public static function create(?string $value = null): AnimalSpeciesName
    {
        return new AnimalSpeciesName($value ?? WordMother::create());
    }
}
