<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Associations\Domain\Exception;

use AnimalSociety\Shared\Domain\Http\Exception\ApiResponseException;

class AssociationEmailInvalidException extends ApiResponseException
{
    public const string MESSAGE = 'Invalid association email';
    public const int CODE = 104;
}
