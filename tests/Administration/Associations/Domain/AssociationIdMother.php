<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Associations\Domain;

use AnimalSociety\Administration\Associations\Domain\AssociationId;
use AnimalSociety\Tests\Shared\Domain\UuidMother;

final class AssociationIdMother
{
    public static function create(?string $value = null): AssociationId
    {
        return new AssociationId($value ?? UuidMother::create());
    }
}
