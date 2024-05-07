<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Domain\Exception\Auth;

use AnimalSociety\Shared\Domain\Http\Exception\ApiResponseException;

class UserNotAuthenticatedException extends ApiResponseException
{
    public const string MESSAGE = 'User not authenticated';
    public const int CODE = 401;
    public const int HTTP_STATUS = 401;
}
