<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Animals\Application\create;

use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFileExtension;
use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFileMimeType;
use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFileName;
use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFilePath;
use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\AnimalRaceId;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpeciesId;
use AnimalSociety\Administration\Animals\Application\create\CreateAnimalCommand;
use AnimalSociety\Administration\Animals\Domain\AnimalAge;
use AnimalSociety\Administration\Animals\Domain\AnimalId;
use AnimalSociety\Administration\Animals\Domain\AnimalName;
use AnimalSociety\Administration\Associations\Domain\AssociationId;
use AnimalSociety\Tests\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFileExtensionMother;
use AnimalSociety\Tests\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFileMimeTypeMother;
use AnimalSociety\Tests\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFileNameMother;
use AnimalSociety\Tests\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFilePathMother;
use AnimalSociety\Tests\Administration\Animals\AnimalRaces\Domain\AnimalRaceIdMother;
use AnimalSociety\Tests\Administration\Animals\AnimalSpecies\Domain\AnimalSpeciesIdMother;
use AnimalSociety\Tests\Administration\Animals\Domain\AnimalAgeMother;
use AnimalSociety\Tests\Administration\Animals\Domain\AnimalIdMother;
use AnimalSociety\Tests\Administration\Animals\Domain\AnimalNameMother;
use AnimalSociety\Tests\Administration\Associations\Domain\AssociationIdMother;

final class CreateAnimalCommandMother
{
    public static function create(
        ?AnimalId $id = null,
        ?AssociationId $associationId = null,
        ?AnimalName $name = null,
        ?AnimalSpeciesId $speciesId = null,
        ?AnimalRaceId $raceId = null,
        ?AnimalAge $age = null,
        ?AnimalPhotoFilePath $animalPhotoFilePath = null,
        ?AnimalPhotoFileName $animalPhotoFileName = null,
        ?AnimalPhotoFileExtension $animalPhotoFileExtension = null,
        ?AnimalPhotoFileMimeType $animalPhotoFileMimeType = null,
    ): CreateAnimalCommand {
        return new CreateAnimalCommand(
            $id?->value() ?? AnimalIdMother::create()->value(),
            $associationId?->value() ?? AssociationIdMother::create()->value(),
            $name?->value() ?? AnimalNameMother::create()->value(),
            $speciesId?->value() ?? AnimalSpeciesIdMother::create()->value(),
            $raceId?->value() ?? AnimalRaceIdMother::create()->value(),
            $age?->value() ?? AnimalAgeMother::create()->value(),
            $animalPhotoFilePath?->value() ?? AnimalPhotoFilePathMother::create()->value(),
            $animalPhotoFileName?->value() ?? AnimalPhotoFileNameMother::create()->value(),
            $animalPhotoFileMimeType?->value() ?? AnimalPhotoFileMimeTypeMother::create()->value(),
            $animalPhotoFileExtension?->value() ?? AnimalPhotoFileExtensionMother::create()->value(),
        );
    }
}
