<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Animals\AnimalPhotos\Domain;

use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFileName;
use AnimalSociety\Tests\Shared\Domain\FileNameMother;

final class AnimalPhotoFileNameMother
{
    public static function create(?string $value = null): AnimalPhotoFileName
    {
        return new AnimalPhotoFileName($value ?? FileNameMother::create());
    }
}
