<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Animals\AnimalRaces\Domain;

use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\AnimalRaceName;
use AnimalSociety\Tests\Shared\Domain\WordMother;

final class AnimalRaceNameMother
{
    public static function create(?string $value = null): AnimalRaceName
    {
        return new AnimalRaceName($value ?? WordMother::create());
    }
}
