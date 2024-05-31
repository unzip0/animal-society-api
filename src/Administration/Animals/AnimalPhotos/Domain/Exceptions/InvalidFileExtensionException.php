<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\AnimalPhotos\Domain\Exception;

use AnimalSociety\Shared\Domain\Http\Exception\ApiResponseException;

class InvalidFileExtensionException extends ApiResponseException
{
    public const string MESSAGE = 'Invalid file extension';
    public const int CODE = 108;
}
