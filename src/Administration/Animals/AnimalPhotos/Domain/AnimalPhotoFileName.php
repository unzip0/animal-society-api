<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\AnimalPhotos\Domain;

use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\Exception\InvalidFileNameException;
use AnimalSociety\Shared\Domain\ValueObject\StringValueObject;

final class AnimalPhotoFileName extends StringValueObject
{
    private const string VALID_FILE_NAME_REGEX = '/^[a-zA-Z0-9\.\-_]+$/';

    public function __construct(string $fileName)
    {
        parent::__construct($fileName);
        $this->ensureIsValidFileName($fileName);
    }

    private function ensureIsValidFileName(string $fileName): void
    {
        if (!(bool) preg_match(self::VALID_FILE_NAME_REGEX, $fileName)) {
            throw InvalidFileNameException::create();
        }
    }
}
