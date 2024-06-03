<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Associations\Domain\Exceptions;

use AnimalSociety\Shared\Domain\Http\Exception\ApiResponseException;

class AssociationNotFoundException extends ApiResponseException
{
    public const int HTTP_STATUS = 404;
    public const string MESSAGE = 'Association not found';
    public const int CODE = 113;
}
