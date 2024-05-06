<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Domain\Exception;

use AnimalSociety\Shared\Domain\Http\Exception\ApiResponseException;

class InvalidEmailException extends ApiResponseException
{
    public const string MESSAGE = 'Invalid email';
    public const int CODE = 300;
}
