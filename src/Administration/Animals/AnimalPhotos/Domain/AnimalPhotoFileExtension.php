<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\AnimalPhotos\Domain;

use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\Exceptions\InvalidFileNameException;
use AnimalSociety\Shared\Domain\ValueObject\StringValueObject;

final class AnimalPhotoFileExtension extends StringValueObject
{
    private const string EXTENSION_PNG = 'png';
    private const string EXTENSION_JPG = 'jpg';
    private const string EXTENSION_JPEG = 'jpeg';
    private const array ALLOWED_EXTENSIONS = [
        self::EXTENSION_PNG,
        self::EXTENSION_JPG,
        self::EXTENSION_JPEG,
    ];

    public function __construct(string $extension)
    {
        parent::__construct($extension);
        $this->ensureIsValidFileExtension($extension);
    }

    private function ensureIsValidFileExtension(string $extension): void
    {
        if (!in_array($extension, self::ALLOWED_EXTENSIONS, true)) {
            throw InvalidFileNameException::create();
        }
    }
}
