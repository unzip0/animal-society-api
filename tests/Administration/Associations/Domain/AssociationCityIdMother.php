<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Associations\Domain;

use AnimalSociety\Administration\Associations\Domain\AssociationCityId;
use AnimalSociety\Tests\Shared\Domain\IntegerMother;

final class AssociationCityIdMother
{
    public static function create(?int $value = null): AssociationCityId
    {
        return new AssociationCityId($value ?? IntegerMother::create());
    }
}
