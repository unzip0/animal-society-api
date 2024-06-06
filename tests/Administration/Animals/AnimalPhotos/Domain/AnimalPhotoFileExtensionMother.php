<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Animals\AnimalPhotos\Domain;

use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFileExtension;
use AnimalSociety\Tests\Shared\Domain\FileExtensionMother;

final class AnimalPhotoFileExtensionMother
{
    public static function create(?string $value = null): AnimalPhotoFileExtension
    {
        return new AnimalPhotoFileExtension($value ?? FileExtensionMother::create());
    }
}
