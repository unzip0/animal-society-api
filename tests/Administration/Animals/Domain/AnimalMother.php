<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Animals\Domain;

use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhoto;
use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\AnimalRaceId;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpeciesId;
use AnimalSociety\Administration\Animals\Application\create\CreateAnimalCommand;
use AnimalSociety\Administration\Animals\Domain\Animal;
use AnimalSociety\Administration\Animals\Domain\AnimalAge;
use AnimalSociety\Administration\Animals\Domain\AnimalId;
use AnimalSociety\Administration\Animals\Domain\AnimalName;
use AnimalSociety\Administration\Associations\Domain\AssociationId;
use AnimalSociety\Tests\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFileExtensionMother;
use AnimalSociety\Tests\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFileMimeTypeMother;
use AnimalSociety\Tests\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFileNameMother;
use AnimalSociety\Tests\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFilePathMother;
use AnimalSociety\Tests\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoMother;
use AnimalSociety\Tests\Administration\Animals\AnimalRaces\Domain\AnimalRaceIdMother;
use AnimalSociety\Tests\Administration\Animals\AnimalSpecies\Domain\AnimalSpeciesIdMother;
use AnimalSociety\Tests\Administration\Associations\Domain\AssociationIdMother;

final class AnimalMother
{
    public static function create(
        ?AnimalId $id = null,
        ?AssociationId $associationId = null,
        ?AnimalName $name = null,
        ?AnimalSpeciesId $speciesId = null,
        ?AnimalRaceId $raceId = null,
        ?AnimalAge $age = null,
        ?AnimalPhoto $photo = null,
        ?bool $available = null,
    ): Animal {
        return new Animal(
            $id ?? AnimalIdMother::create(),
            $associationId ?? AssociationIdMother::create(),
            $name ?? AnimalNameMother::create(),
            $speciesId ?? AnimalSpeciesIdMother::create(),
            $raceId ?? AnimalRaceIdMother::create(),
            $age ?? AnimalAgeMother::create(),
            $photo ?? AnimalPhotoMother::create(),
            $available ?? true
        );
    }

    public static function fromRequest(CreateAnimalCommand $request): Animal
    {
        $animalId = AnimalIdMother::create($request->id());
        return self::create(
            $animalId,
            AssociationIdMother::create($request->associationId()),
            AnimalNameMother::create($request->name()),
            AnimalSpeciesIdMother::create($request->speciesId()),
            AnimalRaceIdMother::create($request->raceId()),
            AnimalAgeMother::create($request->age()),
            AnimalPhotoMother::create(
                $animalId,
                AnimalPhotoFileNameMother::create($request->photoName()),
                AnimalPhotoFilePathMother::create($request->photoPath()),
                AnimalPhotoFileExtensionMother::create($request->photoExtension()),
                AnimalPhotoFileMimeTypeMother::create($request->photoMimeType()),
            ),
            true
        );
    }
}
