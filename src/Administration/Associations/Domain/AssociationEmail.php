<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Associations\Domain;

use AnimalSociety\Shared\Domain\ValueObject\StringValueObject;
use Exception;

final class AssociationEmail extends StringValueObject
{
    public function __construct(string $email)
    {
        parent::__construct($email);

        $this->validateEmail($email);
    }

    private function validateEmail(string $email): void
    {
        if (!(bool) filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid email');
        }
    }
}
