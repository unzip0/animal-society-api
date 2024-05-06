<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Domain\Exception;

use AnimalSociety\Shared\Domain\Http\Exception\ApiResponseException;

class UserInvalidRoleException extends ApiResponseException
{
    public const string MESSAGE = 'Invalid role';
    public const int CODE = 102;
}
