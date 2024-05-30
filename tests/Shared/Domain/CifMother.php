<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Shared\Domain;

final class CifMother
{
    /**
     * Require implement faker cif value
     */
    public static function create(): string
    {
        return 'W0959685I';
        // return MotherCreator::random()->cif();
    }
}
