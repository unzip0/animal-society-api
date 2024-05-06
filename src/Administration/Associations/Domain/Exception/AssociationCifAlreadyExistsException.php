<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Associations\Domain\Exception;

use AnimalSociety\Shared\Domain\Http\Exception\ApiResponseException;

class AssociationCifAlreadyExistsException extends ApiResponseException
{
    public const string MESSAGE = 'CIF already registered';
    public const int CODE = 100;
}
