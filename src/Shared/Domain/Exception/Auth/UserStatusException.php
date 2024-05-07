<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Domain\Exception\Auth;

use AnimalSociety\Shared\Domain\Http\Exception\ApiResponseException;

class UserStatusException extends ApiResponseException
{
    public const string MESSAGE = 'User is not active';
    public const int CODE = 302;
}
