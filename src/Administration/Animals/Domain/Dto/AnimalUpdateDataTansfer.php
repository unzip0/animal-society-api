<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\Domain\Dto;

use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhoto;
use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFileExtension;
use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFileMimeType;
use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFileName;
use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFilePath;
use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\AnimalRaceId;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpeciesId;
use AnimalSociety\Administration\Animals\Domain\AnimalAge;
use AnimalSociety\Administration\Animals\Domain\AnimalId;
use AnimalSociety\Administration\Animals\Domain\AnimalName;
use AnimalSociety\Administration\Associations\Domain\AssociationId;

final class AnimalUpdateDataTansfer
{
    public function __construct(
        public AnimalId $id,
        public AssociationId $associationId,
        public AnimalName $name,
        public AnimalSpeciesId $speciesId,
        public AnimalRaceId $raceId,
        public AnimalAge $age,
        public ?AnimalPhoto $photo = null
    ) {}

    public static function create(
        string $id,
        string $associationId,
        string $name,
        string $speciesId,
        string $raceId,
        int $age,
        ?string $photoPath,
        ?string $photoName,
        ?string $photoMimeType,
        ?string $photoExtension,
    ): self {
        $animalPhoto = $photoPath !== null
            ? new AnimalPhoto(
                animalId: new AnimalId($id),
                animalPhotoFileName: new AnimalPhotoFileName($photoName),
                animalPhotoFilePath: new AnimalPhotoFilePath($photoPath),
                animalPhotoFileMimeType: new AnimalPhotoFileMimeType($photoMimeType),
                animalPhotoFileExtension: new AnimalPhotoFileExtension($photoExtension)
            ) : null;
        return new self(
            id: new AnimalId($id),
            associationId: new AssociationId($associationId),
            name: new AnimalName($name),
            speciesId: new AnimalSpeciesId($speciesId),
            raceId: new AnimalRaceId($raceId),
            age: new AnimalAge($age),
            photo: $animalPhoto
        );
    }
}
