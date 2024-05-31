<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\AnimalPhotos\Domain;

use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\Exception\InvalidFileNameException;
use AnimalSociety\Shared\Domain\ValueObject\StringValueObject;

final class AnimalPhotoFileMimeType extends StringValueObject
{
    private const string MIMETYPE_PNG = 'png';
    private const string MIMETYPE_JPG = 'jpg';
    private const array ALLOWED_MIMETYPES = [
        self::MIMETYPE_PNG,
        self::MIMETYPE_JPG,
    ];

    public function __construct(string $mimetype)
    {
        parent::__construct($mimetype);
        $this->ensureIsValidFileMimeType($mimetype);
    }

    private function ensureIsValidFileMimeType(string $mimetype): void
    {
        if (!in_array($mimetype, self::ALLOWED_MIMETYPES, true)) {
            throw InvalidFileNameException::create();
        }
    }
}
