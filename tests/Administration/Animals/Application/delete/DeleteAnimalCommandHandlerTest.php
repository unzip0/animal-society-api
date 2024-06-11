<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Animals\Application\delete;

use AnimalSociety\Administration\Animals\Application\delete\AnimalDeleter;
use AnimalSociety\Administration\Animals\Application\delete\DeleteAnimalCommandHandler;
use AnimalSociety\Administration\Animals\Domain\Animal;
use AnimalSociety\Administration\Animals\Domain\Exceptions\AnimalNotFoundException;
use AnimalSociety\Shared\Domain\FileSystem\Storage;
use AnimalSociety\Tests\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFileExtensionMother;
use AnimalSociety\Tests\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFileMimeTypeMother;
use AnimalSociety\Tests\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoMother;
use AnimalSociety\Tests\Administration\Animals\AnimalRaces\Domain\AnimalRaceMother;
use AnimalSociety\Tests\Administration\Animals\AnimalsModuleUnitTestCase;
use AnimalSociety\Tests\Administration\Animals\AnimalSpecies\Domain\AnimalSpeciesMother;
use AnimalSociety\Tests\Administration\Animals\Domain\AnimalIdMother;
use AnimalSociety\Tests\Administration\Animals\Domain\AnimalMother;
use AnimalSociety\Tests\Administration\Associations\Domain\AssociationIdMother;
use AnimalSociety\Tests\Administration\Associations\Domain\AssociationMother;
use AnimalSociety\Tests\CreatesApplication;
use Mockery\MockInterface;

final class DeleteAnimalCommandHandlerTest extends AnimalsModuleUnitTestCase
{
    use CreatesApplication;
    private DeleteAnimalCommandHandler|null $handler;
    private Storage|MockInterface|null $storage;
    private Animal $animal;

    protected function setUp(): void
    {
        parent::setUp();

        $this->animal = $this->createAnimal();

        $this->storage = $this->mock(Storage::class);

        $this->handler = new DeleteAnimalCommandHandler(
            new AnimalDeleter(
                $this->repository(),
                $this->storage
            )
        );
    }

    public function testItShouldDeleteAnimal(): void
    {
        $animal = $this->animal;

        $command = DeleteAnimalCommandMother::create(
            animalId: $animal->animalId(),
            associationId: $animal->animalAssociationId(),
        );

        $this->shouldFindById($animal->animalId(), $animal);

        $this->storage->shouldReceive('delete')
            ->once()
            ->with($this->similarTo($animal->animalPhoto()));

        $this->shouldDelete($animal);

        $this->dispatch($command, $this->handler);
    }

    public function testItShouldThrowExceptionWhenAnimalNotFound(): void
    {
        $animal = $this->animal;

        $command = DeleteAnimalCommandMother::create(
            animalId: $animal->animalId(),
            associationId: $animal->animalAssociationId(),
        );

        $this->shouldNotFindById($animal->animalId());

        $this->expectException(AnimalNotFoundException::class);

        $this->dispatch($command, $this->handler);
    }

    public function testItShouldThrowExceptionWhenAssociationIdDoesNotMatch(): void
    {
        $animal = $this->animal;

        $command = DeleteAnimalCommandMother::create(
            animalId: $animal->animalId(),
            associationId: AssociationIdMother::create(),
        );

        $this->shouldFindById($animal->animalId(), $animal);

        $this->expectException(AnimalNotFoundException::class);

        $this->dispatch($command, $this->handler);
    }

    private function createAnimal(): Animal
    {
        $animalId = AnimalIdMother::create();
        $association = AssociationMother::create();
        $animalSpecies = AnimalSpeciesMother::create();
        $animalRace = AnimalRaceMother::create(
            speciesId: $animalSpecies->animalSpeciesId()
        );
        $animalPhoto = AnimalPhotoMother::create(
            id: $animalId,
            animalPhotoFileExtension: AnimalPhotoFileExtensionMother::create('jpg'),
            animalPhotoFileMimeType: AnimalPhotoFileMimeTypeMother::create('image/jpeg'),
        );

        $animal = AnimalMother::create(
            id: $animalId,
            associationId: $association->id(),
            speciesId: $animalSpecies->animalSpeciesId(),
            raceId: $animalRace->animalRaceId(),
            photo: $animalPhoto
        );

        return $animal;
    }
}
