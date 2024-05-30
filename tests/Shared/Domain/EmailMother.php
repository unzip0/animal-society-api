<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Shared\Domain;

final class EmailMother
{
    public static function create(): string
    {
        return MotherCreator::random()->unique()->safeEmail;
    }
}
