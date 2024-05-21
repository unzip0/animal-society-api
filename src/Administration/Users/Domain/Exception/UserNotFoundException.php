<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Domain\Exception;

use AnimalSociety\Shared\Domain\Http\Exception\ApiResponseException;

class UserNotFoundException extends ApiResponseException
{
    public const int HTTP_STATUS = 404;
    public const string MESSAGE = 'User not found';
    public const int CODE = 106;
}
