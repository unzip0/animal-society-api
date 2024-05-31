<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Shared\Domain;

final class RoleMother
{
    /**
     * @todo Require implement allowed random roles
     */
    public static function create(): string
    {
        return 'admin';
        // return MotherCreator::random();
    }
}
