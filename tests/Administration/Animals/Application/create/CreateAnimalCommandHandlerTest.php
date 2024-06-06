<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Animals\Application\create;

use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\AnimalRaceRepository;
use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\Exceptions\AnimalRaceNotFoundException;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpeciesRepository;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\Exceptions\AnimalSpeciesNotFoundException;
use AnimalSociety\Administration\Animals\Application\create\AnimalCreator;
use AnimalSociety\Administration\Animals\Application\create\CreateAnimalCommandHandler;
use AnimalSociety\Administration\Associations\Domain\AssociationRepository;
use AnimalSociety\Administration\Associations\Domain\Exception\AssociationNotFoundException;
use AnimalSociety\Shared\Domain\FileSystem\Storage;
use AnimalSociety\Tests\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFileExtensionMother;
use AnimalSociety\Tests\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFileMimeTypeMother;
use AnimalSociety\Tests\Administration\Animals\AnimalRaces\Domain\AnimalRaceMother;
use AnimalSociety\Tests\Administration\Animals\AnimalsModuleUnitTestCase;
use AnimalSociety\Tests\Administration\Animals\AnimalSpecies\Domain\AnimalSpeciesMother;
use AnimalSociety\Tests\Administration\Animals\Domain\AnimalMother;
use AnimalSociety\Tests\Administration\Associations\Domain\AssociationMother;
use AnimalSociety\Tests\CreatesApplication;
use Mockery\MockInterface;

final class CreateAnimalCommandHandlerTest extends AnimalsModuleUnitTestCase
{
    use CreatesApplication;
    private CreateAnimalCommandHandler|null $handler;
    private AssociationRepository|MockInterface|null $associationRepository;
    private AnimalSpeciesRepository|MockInterface|null $animalSpeciesRepository;
    private AnimalRaceRepository|MockInterface|null $animalRaceRepository;
    private Storage|MockInterface|null $storage;

    protected function setUp(): void
    {
        parent::setUp();

        $this->associationRepository = $this->mock(AssociationRepository::class);
        $this->animalSpeciesRepository = $this->mock(AnimalSpeciesRepository::class);
        $this->animalRaceRepository = $this->mock(AnimalRaceRepository::class);
        $this->storage = $this->mock(Storage::class);

        $this->handler = new CreateAnimalCommandHandler(
            new AnimalCreator(
                $this->repository(),
                $this->associationRepository,
                $this->animalSpeciesRepository,
                $this->animalRaceRepository,
                $this->storage
            )
        );
    }

    public function testItShouldCreateValidAnimal(): void
    {
        $association = AssociationMother::create();
        $animalSpecies = AnimalSpeciesMother::create();
        $animalRace = AnimalRaceMother::create(
            speciesId: $animalSpecies->animalSpeciesId()
        );
        $command = CreateAnimalCommandMother::create(
            associationId: $association->id(),
            speciesId: $animalSpecies->animalSpeciesId(),
            raceId: $animalRace->animalRaceId(),
            animalPhotoFileExtension: AnimalPhotoFileExtensionMother::create('jpg'),
            animalPhotoFileMimeType: AnimalPhotoFileMimeTypeMother::create('image/jpeg'),
        );
        $animal = AnimalMother::fromRequest($command);

        $this->associationRepository->shouldReceive('findById')
            ->once()
            ->with($command->associationId())
            ->andReturn($association);

        $this->animalSpeciesRepository->shouldReceive('findById')
            ->once()
            ->with($command->speciesId())
            ->andReturn($animalSpecies);

        $this->animalRaceRepository->shouldReceive('findById')
            ->once()
            ->with($command->raceId())
            ->andReturn($animalRace);

        $this->shouldCreate($animal);

        $this->storage->shouldReceive('store')
            ->once()
            ->with($this->similarTo($animal->animalPhoto()));

        $this->dispatch($command, $this->handler);
    }

    public function testItShouldThrowExceptionIfAssociationNotFound(): void
    {
        $command = CreateAnimalCommandMother::create(
            animalPhotoFileExtension: AnimalPhotoFileExtensionMother::create('jpg'),
            animalPhotoFileMimeType: AnimalPhotoFileMimeTypeMother::create('image/jpeg'),
        );

        $this->associationRepository->shouldReceive('findById')
            ->once()
            ->with($command->associationId())
            ->andReturnNull();

        $this->expectException(AssociationNotFoundException::class);
        $this->dispatch($command, $this->handler);
    }

    public function testItShouldThrowExceptionIfAnimalSpeciesNotFound(): void
    {
        $association = AssociationMother::create();
        $animalSpecies = AnimalSpeciesMother::create();
        $command = CreateAnimalCommandMother::create(
            associationId: $association->id(),
            speciesId: $animalSpecies->animalSpeciesId(),
            animalPhotoFileExtension: AnimalPhotoFileExtensionMother::create('jpg'),
            animalPhotoFileMimeType: AnimalPhotoFileMimeTypeMother::create('image/jpeg'),
        );

        $this->associationRepository->shouldReceive('findById')
            ->once()
            ->with($command->associationId())
            ->andReturn($association);

        $this->animalSpeciesRepository->shouldReceive('findById')
            ->once()
            ->with($command->speciesId())
            ->andReturnNull();

        $this->expectException(AnimalSpeciesNotFoundException::class);
        $this->dispatch($command, $this->handler);
    }

    public function testItShouldThrowExceptionIfAnimalRaceNotFound(): void
    {
        $association = AssociationMother::create();
        $animalSpecies = AnimalSpeciesMother::create();
        $animalRace = AnimalRaceMother::create(
            speciesId: $animalSpecies->animalSpeciesId()
        );
        $command = CreateAnimalCommandMother::create(
            associationId: $association->id(),
            speciesId: $animalSpecies->animalSpeciesId(),
            raceId: $animalRace->animalRaceId(),
            animalPhotoFileExtension: AnimalPhotoFileExtensionMother::create('jpg'),
            animalPhotoFileMimeType: AnimalPhotoFileMimeTypeMother::create('image/jpeg'),
        );

        $this->associationRepository->shouldReceive('findById')
            ->once()
            ->with($command->associationId())
            ->andReturn($association);

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
}
