<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Associations\Domain;

use AnimalSociety\Administration\Associations\Domain\AssociationCif;
use AnimalSociety\Tests\Shared\Domain\CifMother;

final class AssociationCifMother
{
    public static function create(?string $value = null): AssociationCif
    {
        return new AssociationCif($value ?? CifMother::create());
    }
}
