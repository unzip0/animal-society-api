<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\Exceptions;

use AnimalSociety\Shared\Domain\Http\Exception\ApiResponseException;

class AnimalSpeciesNotFoundException extends ApiResponseException
{
    public const int HTTP_STATUS = 404;
    public const string MESSAGE = 'Animal species not found';
    public const int CODE = 111;
}
