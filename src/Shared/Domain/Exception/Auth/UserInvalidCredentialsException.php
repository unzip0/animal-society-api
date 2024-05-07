<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Domain\Exception\Auth;

use AnimalSociety\Shared\Domain\Http\Exception\ApiResponseException;

class UserInvalidCredentialsException extends ApiResponseException
{
    public const string MESSAGE = 'Invalid credentials';
    public const int CODE = 301;
}
