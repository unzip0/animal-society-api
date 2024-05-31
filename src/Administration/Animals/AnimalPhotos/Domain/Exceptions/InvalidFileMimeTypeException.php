<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\AnimalPhotos\Domain\Exception;

use AnimalSociety\Shared\Domain\Http\Exception\ApiResponseException;

class InvalidFileMimeTypeException extends ApiResponseException
{
    public const string MESSAGE = 'Invalid file mime type';
    public const int CODE = 109;
}
