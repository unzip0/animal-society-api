<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Domain;

use AnimalSociety\Administration\Users\Domain\Exception\UserInvalidPasswordException;
use AnimalSociety\Shared\Domain\ValueObject\StringValueObject;

final class UserPassword extends StringValueObject
{
    private const string PASSWORD_REGEXP = '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/';

    public function __construct(string $password)
    {
        parent::__construct($password);

        $this->validatePassword($password);
    }

    private function validatePassword(string $password): void
    {
        if (!(bool) preg_match(self::PASSWORD_REGEXP, $password)) {
            throw UserInvalidPasswordException::create();
        }
    }
}
