<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Domain\Exception;

use AnimalSociety\Shared\Domain\Http\Exception\ApiResponseException;

class UserInvalidPasswordException extends ApiResponseException
{
    public const string MESSAGE = 'Invalid password';
    public const int CODE = 105;
}
