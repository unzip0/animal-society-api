<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\AnimalPhotos\Domain;

use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\Exceptions\InvalidFileMimeTypeException;
use AnimalSociety\Shared\Domain\ValueObject\StringValueObject;

final class AnimalPhotoFileMimeType extends StringValueObject
{
    private const string MIMETYPE_PNG = 'image/png';
    private const string MIMETYPE_JPG = 'image/jpg';
    private const string MIMETYPE_JPEG = 'image/jpeg';
    private const array ALLOWED_MIMETYPES = [
        self::MIMETYPE_PNG,
        self::MIMETYPE_JPG,
        self::MIMETYPE_JPEG,
    ];

    public function __construct(string $mimetype)
    {
        parent::__construct($mimetype);
        $this->ensureIsValidFileMimeType($mimetype);
    }

    private function ensureIsValidFileMimeType(string $mimetype): void
    {
        if (!in_array($mimetype, self::ALLOWED_MIMETYPES, true)) {
            throw InvalidFileMimeTypeException::create();
        }
    }
}
