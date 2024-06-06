<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Animals\Domain;

use AnimalSociety\Administration\Animals\Domain\AnimalName;
use AnimalSociety\Tests\Shared\Domain\WordMother;

final class AnimalNameMother
{
    public static function create(?string $value = null): AnimalName
    {
        return new AnimalName($value ?? WordMother::create());
    }
}
