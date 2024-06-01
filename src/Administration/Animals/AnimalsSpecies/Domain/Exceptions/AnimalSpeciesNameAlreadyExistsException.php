<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\Exceptions;

use AnimalSociety\Shared\Domain\Http\Exception\ApiResponseException;

class AnimalSpeciesNameAlreadyExistsException extends ApiResponseException
{
    public const string MESSAGE = 'Animal species name already exists';
    public const int CODE = 110;
}
