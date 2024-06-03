<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\AnimalsRaces\Domain\Exceptions;

use AnimalSociety\Shared\Domain\Http\Exception\ApiResponseException;

class AnimalRaceNotFoundException extends ApiResponseException
{
    public const int HTTP_STATUS = 404;
    public const string MESSAGE = 'Animal race not found';
    public const int CODE = 112;
}
