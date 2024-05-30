<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Associations\Domain;

use AnimalSociety\Administration\Associations\Domain\AssociationEmail;
use AnimalSociety\Tests\Shared\Domain\EmailMother;

final class AssociationEmailMother
{
    public static function create(?string $value = null): AssociationEmail
    {
        return new AssociationEmail($value ?? EmailMother::create());
    }
}
