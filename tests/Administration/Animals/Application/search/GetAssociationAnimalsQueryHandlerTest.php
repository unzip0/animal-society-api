<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Animals\Application\search;

use AnimalSociety\Administration\Animals\Application\search\AnimalSearcher;
use AnimalSociety\Administration\Animals\Application\search\GetAssociationAnimalsQueryHandler;
use AnimalSociety\Tests\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFileExtensionMother;
use AnimalSociety\Tests\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFileMimeTypeMother;
use AnimalSociety\Tests\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoMother;
use AnimalSociety\Tests\Administration\Animals\AnimalRaces\Domain\AnimalRaceMother;
use AnimalSociety\Tests\Administration\Animals\AnimalsModuleUnitTestCase;
use AnimalSociety\Tests\Administration\Animals\AnimalSpecies\Domain\AnimalSpeciesMother;
use AnimalSociety\Tests\Administration\Animals\Domain\AnimalIdMother;
use AnimalSociety\Tests\Administration\Animals\Domain\AnimalMother;
use AnimalSociety\Tests\Administration\Associations\Domain\AssociationMother;
use AnimalSociety\Tests\CreatesApplication;

final class GetAssociationAnimalsQueryHandlerTest extends AnimalsModuleUnitTestCase
{
    use CreatesApplication;
    private GetAssociationAnimalsQueryHandler|null $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new GetAssociationAnimalsQueryHandler(
            new AnimalSearcher(
                $this->repository(),
            )
        );
    }

    public function testItShouldGetAssociationAnimals(): void
    {
        $query = GetAssociationAnimalsQueryMother::create();
        $association = AssociationMother::create();
        $animalSpecies = AnimalSpeciesMother::create();
        $animalRace = AnimalRaceMother::create(
            speciesId: $animalSpecies->animalSpeciesId()
        );
        $animalId = AnimalIdMother::create();
        $animalPhoto = AnimalPhotoMother::create(
            id: $animalId,
            animalPhotoFileExtension: AnimalPhotoFileExtensionMother::create('jpg'),
            animalPhotoFileMimeType: AnimalPhotoFileMimeTypeMother::create('image/jpeg'),
        );
        $animal = AnimalMother::create(
            associationId: $association->id(),
            speciesId: $animalSpecies->animalSpeciesId(),
            raceId: $animalRace->animalRaceId(),
            photo: $animalPhoto
        );
        $animalResponse = AnimalResponseMother::create(
            id: $animal->animalId()->value(),
            name: $animal->animalName()->value(),
            speciesId: $animal->animalSpeciesId()->value(),
            raceId: $animal->animalRaceId()->value(),
            age: $animal->animalAge()->value(),
            available: $animal->isAvailable()
        );

        $response = AnimalsResponseMother::create(
            $animalResponse
        );
        $this->shouldMatchByCriteria($animal);

        $this->assertAskResponse($response, $query, $this->handler);
    }
}
