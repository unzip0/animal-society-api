<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Animals\Domain;

use AnimalSociety\Administration\Animals\Domain\AnimalAge;
use AnimalSociety\Tests\Shared\Domain\IntegerMother;

final class AnimalAgeMother
{
    public static function create(?int $value = null): AnimalAge
    {
        return new AnimalAge($value ?? IntegerMother::create());
    }
}
