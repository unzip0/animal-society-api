<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Associations\Domain\Exception;

use AnimalSociety\Shared\Domain\Http\Exception\ApiResponseException;

class AssociationCifInvalidException extends ApiResponseException
{
    public const string MESSAGE = 'CIF invalid';
    public const int CODE = 101;
}
