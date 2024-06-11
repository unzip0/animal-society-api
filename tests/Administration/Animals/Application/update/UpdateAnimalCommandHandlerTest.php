<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Animals\Application\update;

use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\AnimalRace;
use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\AnimalRaceRepository;
use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\Exceptions\AnimalRaceNotFoundException;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpecies;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpeciesRepository;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\Exceptions\AnimalSpeciesNotFoundException;
use AnimalSociety\Administration\Animals\Application\update\AnimalUpdate;
use AnimalSociety\Administration\Animals\Application\update\UpdateAnimalCommandHandler;
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
use AnimalSociety\Tests\Administration\Associations\Domain\AssociationMother;
use AnimalSociety\Tests\CreatesApplication;
use Mockery\MockInterface;

final class UpdateAnimalCommandHandlerTest extends AnimalsModuleUnitTestCase
{
    use CreatesApplication;
    private UpdateAnimalCommandHandler|null $handler;
    private AnimalSpeciesRepository|MockInterface|null $animalSpeciesRepository;
    private AnimalRaceRepository|MockInterface|null $animalRaceRepository;
    private Storage|MockInterface|null $storage;
    private Animal $animal;
    private AnimalSpecies $animalSpecies;
    private AnimalRace $animalRace;

    protected function setUp(): void
    {
        parent::setUp();

        [
            $this->animal,
            $this->animalSpecies,
            $this->animalRace
        ] = $this->createAnimal();

        $this->animalSpeciesRepository = $this->mock(AnimalSpeciesRepository::class);
        $this->animalRaceRepository = $this->mock(AnimalRaceRepository::class);
        $this->storage = $this->mock(Storage::class);

        $this->handler = new UpdateAnimalCommandHandler(
            new AnimalUpdate(
                $this->repository(),
                $this->animalSpeciesRepository,
                $this->animalRaceRepository,
                $this->storage
            )
        );
    }

    public function testItShouldUpdateAnimal(): void
    {
        $animal = $this->animal;
        $animalSpecies = $this->animalSpecies;
        $animalRace = $this->animalRace;

        $command = UpdateAnimalCommandMother::create(
            id: $animal->animalId()->value(),
            associationId: $animal->animalAssociationId()->value(),
            name: $animal->animalName()->value(),
            speciesId: $animal->animalSpeciesId()->value(),
            raceId: $animal->animalRaceId()->value(),
            age: $animal->animalAge()->value(),
            photoPath: null,
            photoName: null,
            photoMimeType: null,
            photoExtension: null,
        );

        $this->shouldFindById($animal->animalId(), $animal);

        $this->animalSpeciesRepository->shouldReceive('findById')
            ->once()
            ->with($command->speciesId())
            ->andReturn($animalSpecies);

        $this->animalRaceRepository->shouldReceive('findById')
            ->once()
            ->with($command->raceId())
            ->andReturn($animalRace);

        $this->shouldUpdate($animal);

        $this->dispatch($command, $this->handler);
    }

    public function testItShouldUpdateAnimalAndReplacePhoto(): void
    {
        $this->markTestSkipped('update storage expects UploadedFile');
        $animal = $this->animal;
        $animalSpecies = $this->animalSpecies;
        $animalRace = $this->animalRace;

        $command = UpdateAnimalCommandMother::create(
            id: $animal->animalId()->value(),
            associationId: $animal->animalAssociationId()->value(),
            name: $animal->animalName()->value(),
            speciesId: $animal->animalSpeciesId()->value(),
            raceId: $animal->animalRaceId()->value(),
            age: $animal->animalAge()->value(),
            photoPath: 'dummy-path',
            photoName: 'dummy-name.jpg',
            photoMimeType: 'image/jpg',
            photoExtension: 'jpg',
        );

        $this->shouldFindById($animal->animalId(), $animal);

        $this->animalSpeciesRepository->shouldReceive('findById')
            ->once()
            ->with($command->speciesId())
            ->andReturn($animalSpecies);

        $this->animalRaceRepository->shouldReceive('findById')
            ->once()
            ->with($command->raceId())
            ->andReturn($animalRace);

        $this->storage->shouldReceive('update')
            ->once()
            ->with($this->similarTo($animal->animalPhoto()));

        $this->shouldUpdate($animal);

        $this->dispatch($command, $this->handler);
    }

    public function testItShouldThrowExceptionWhenAnimalNotFound(): void
    {
        $animal = $this->animal;

        $command = UpdateAnimalCommandMother::create(
            id: $animal->animalId()->value(),
            name: $animal->animalName()->value(),
            speciesId: $animal->animalSpeciesId()->value(),
            raceId: $animal->animalRaceId()->value(),
            age: $animal->animalAge()->value(),
            photoPath: null,
            photoName: null,
            photoMimeType: null,
            photoExtension: null,
        );

        $this->shouldFindById($animal->animalId(), $animal);

        $this->expectException(AnimalNotFoundException::class);

        $this->dispatch($command, $this->handler);
    }

    public function testItShouldThrowExceptionWhenAssociationIdDoesNotMatch(): void
    {
        $animal = $this->animal;

        $command = UpdateAnimalCommandMother::create(
            id: $animal->animalId()->value(),
            associationId: $animal->animalAssociationId()->value(),
            name: $animal->animalName()->value(),
            speciesId: $animal->animalSpeciesId()->value(),
            raceId: $animal->animalRaceId()->value(),
            age: $animal->animalAge()->value(),
            photoPath: null,
            photoName: null,
            photoMimeType: null,
            photoExtension: null,
        );

        $this->shouldNotFindByid($animal->animalId());

        $this->expectException(AnimalNotFoundException::class);

        $this->dispatch($command, $this->handler);
    }

    public function testItShouldThrowExceptionWhenSpeciesNotFound(): void
    {
        $animal = $this->animal;

        $command = UpdateAnimalCommandMother::create(
            id: $animal->animalId()->value(),
            associationId: $animal->animalAssociationId()->value(),
            name: $animal->animalName()->value(),
            raceId: $animal->animalRaceId()->value(),
            age: $animal->animalAge()->value(),
            photoPath: null,
            photoName: null,
            photoMimeType: null,
            photoExtension: null,
        );

        $this->shouldFindById($animal->animalId(), $animal);

        $this->animalSpeciesRepository->shouldReceive('findById')
            ->once()
            ->with($command->speciesId())
            ->andReturnNull();

        $this->expectException(AnimalSpeciesNotFoundException::class);

        $this->dispatch($command, $this->handler);
    }

    public function testItShouldThrowExceptionWhenRaceNotFound(): void
    {
        $animal = $this->animal;
        $animalSpecies = $this->animalSpecies;

        $command = UpdateAnimalCommandMother::create(
            id: $animal->animalId()->value(),
            associationId: $animal->animalAssociationId()->value(),
            name: $animal->animalName()->value(),
            speciesId: $animal->animalSpeciesId()->value(),
            age: $animal->animalAge()->value(),
            photoPath: null,
            photoName: null,
            photoMimeType: null,
            photoExtension: null,
        );

        $this->shouldFindById($animal->animalId(), $animal);

        $this->animalSpeciesRepository->shouldReceive('findById')
            ->once()
            ->with($command->speciesId())
            ->andReturn($animalSpecies);

        $this->animalRaceRepository->shouldReceive('findById')
            ->once()
            ->with($command->raceId())
            ->andReturnNull();

        $this->expectException(AnimalRaceNotFoundException::class);

        $this->dispatch($command, $this->handler);
    }

    private function createAnimal(): array
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

        return [$animal, $animalSpecies, $animalRace];
    }
}
