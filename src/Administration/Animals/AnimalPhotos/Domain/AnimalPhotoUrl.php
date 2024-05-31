<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\AnimalPhotos\Domain;

use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\Exception\InvalidFileUrlException;
use AnimalSociety\Shared\Domain\ValueObject\StringValueObject;

final class AnimalPhotoUrl extends StringValueObject
{
    public function __construct(string $url)
    {
        parent::__construct($url);
        $this->ensureIsValidUrl($url);
    }

    private function ensureIsValidUrl(string $url): void
    {
        if (!(bool) filter_var($url, FILTER_VALIDATE_URL)) {
            throw InvalidFileUrlException::create();
        }
    }
}
