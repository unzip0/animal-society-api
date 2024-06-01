<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\AnimalPhotos\Domain\Exceptions;

use AnimalSociety\Shared\Domain\Http\Exception\ApiResponseException;

class InvalidFileUrlException extends ApiResponseException
{
    public const string MESSAGE = 'Invalid file url';
    public const int CODE = 109;
}
