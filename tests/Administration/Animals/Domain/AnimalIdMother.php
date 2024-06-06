<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Animals\Domain;

use AnimalSociety\Administration\Animals\Domain\AnimalId;
use AnimalSociety\Tests\Shared\Domain\UuidMother;

final class AnimalIdMother
{
    public static function create(?string $value = null): AnimalId
    {
        return new AnimalId($value ?? UuidMother::create());
    }
}
