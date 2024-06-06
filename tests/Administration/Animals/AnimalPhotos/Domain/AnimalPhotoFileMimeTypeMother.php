<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Animals\AnimalPhotos\Domain;

use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFileMimeType;
use AnimalSociety\Tests\Shared\Domain\FileMimeTypeMother;

final class AnimalPhotoFileMimeTypeMother
{
    public static function create(?string $value = null): AnimalPhotoFileMimeType
    {
        return new AnimalPhotoFileMimeType($value ?? FileMimeTypeMother::create());
    }
}
