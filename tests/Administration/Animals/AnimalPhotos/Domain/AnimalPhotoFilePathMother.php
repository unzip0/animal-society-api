<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Animals\AnimalPhotos\Domain;

use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFilePath;
use AnimalSociety\Tests\Shared\Domain\FilePathMother;

final class AnimalPhotoFilePathMother
{
    public static function create(?string $value = null): AnimalPhotoFilePath
    {
        return new AnimalPhotoFilePath($value ?? FilePathMother::create());
    }
}
