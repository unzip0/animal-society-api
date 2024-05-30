<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Associations\Domain;

use AnimalSociety\Administration\Associations\Domain\AssociationName;
use AnimalSociety\Tests\Shared\Domain\WordMother;

final class AssociationNameMother
{
    public static function create(?string $value = null): AssociationName
    {
        return new AssociationName($value ?? WordMother::create());
    }
}
