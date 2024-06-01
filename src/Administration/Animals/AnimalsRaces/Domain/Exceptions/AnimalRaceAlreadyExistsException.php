<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\AnimalsRaces\Domain\Exceptions;

use AnimalSociety\Shared\Domain\Http\Exception\ApiResponseException;

class AnimalRaceAlreadyExistsException extends ApiResponseException
{
    public const string MESSAGE = 'Animal race already exists';
    public const int CODE = 112;
}
