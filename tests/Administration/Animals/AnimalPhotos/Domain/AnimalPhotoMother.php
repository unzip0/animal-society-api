<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Animals\AnimalPhotos\Domain;

use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhoto;
use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFileExtension;
use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFileMimeType;
use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFileName;
use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFilePath;
use AnimalSociety\Administration\Animals\Application\create\CreateAnimalCommand;
use AnimalSociety\Administration\Animals\Domain\AnimalId;
use AnimalSociety\Tests\Administration\Animals\Domain\AnimalIdMother;

final class AnimalPhotoMother
{
    public static function create(
        ?AnimalId $id = null,
        ?AnimalPhotoFileName $animalPhotoFileName = null,
        ?AnimalPhotoFilePath $animalPhotoFilePath = null,
        ?AnimalPhotoFileExtension $animalPhotoFileExtension = null,
        ?AnimalPhotoFileMimeType $animalPhotoFileMimeType = null,
    ): AnimalPhoto {
        return new AnimalPhoto(
            $id ?? AnimalIdMother::create(),
            $animalPhotoFileName ?? AnimalPhotoFileNameMother::create(),
            $animalPhotoFilePath ?? AnimalPhotoFilePathMother::create(),
            $animalPhotoFileExtension ?? AnimalPhotoFileExtensionMother::create(),
            $animalPhotoFileMimeType ?? AnimalPhotoFileMimeTypeMother::create(),
        );
    }

    public static function fromRequest(CreateAnimalCommand $request): AnimalPhoto
    {
        return self::create(
            AnimalIdMother::create($request->id()),
            AnimalPhotoFileNameMother::create($request->photoName()),
            AnimalPhotoFilePathMother::create($request->photoPath()),
            AnimalPhotoFileExtensionMother::create($request->photoExtension()),
            AnimalPhotoFileMimeTypeMother::create($request->photoMimeType()),
        );
    }
}
