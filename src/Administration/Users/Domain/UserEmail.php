<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Domain;

use AnimalSociety\Shared\Domain\Exception\InvalidEmailException;
use AnimalSociety\Shared\Domain\ValueObject\StringValueObject;

final class UserEmail extends StringValueObject
{
    public function __construct(string $email)
    {
        parent::__construct($email);

        $this->validateEmail($email);
    }

    private function validateEmail(string $email): void
    {
        if (!(bool) filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw InvalidEmailException::create();
        }
    }
}
