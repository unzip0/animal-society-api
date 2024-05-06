<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Domain\Exception;

use AnimalSociety\Shared\Domain\Http\Exception\ApiResponseException;

class UserEmailAreadyUsedException extends ApiResponseException
{
    public const string MESSAGE = 'User email already registered';
    public const int CODE = 103;
}
