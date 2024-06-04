<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Domain\Exception;

use AnimalSociety\Shared\Domain\Http\Exception\ApiResponseException;

class UserNotAllowedException extends ApiResponseException
{
    public const int HTTP_STATUS = 405;
    public const string MESSAGE = 'User not allowed';
    public const int CODE = 114;
}
