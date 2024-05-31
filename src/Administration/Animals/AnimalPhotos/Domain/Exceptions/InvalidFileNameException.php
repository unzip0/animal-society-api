<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\AnimalPhotos\Domain\Exception;

use AnimalSociety\Shared\Domain\Http\Exception\ApiResponseException;

class InvalidFileNameException extends ApiResponseException
{
    public const string MESSAGE = 'Invalid file name';
    public const int CODE = 107;
}
