<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\Application\create;

use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhoto;
use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFileExtension;
use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFileMimeType;
use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFileName;
use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhotoFilePath;
use AnimalSociety\Administration\Animals\Domain\AnimalId;
use AnimalSociety\Shared\Domain\Bus\Command\CommandHandler;

final readonly class CreateAnimalCommandHandler implements CommandHandler
{
    public function __construct(
        private AnimalCreator $creator
    ) {}

    public function __invoke(CreateAnimalCommand $command): void
    {
        $this->creator->__invoke(
            id: $command->id(),
            animalAssociationId: $command->associationId(),
            animalName: $command->name(),
            animalSpeciesId: $command->speciesId(),
            animalRaceId: $command->raceId(),
            animalAge: $command->age(),
            animalPhoto: AnimalPhoto::create(
                animalId: new AnimalId($command->id()),
                animalPhotoFileName: new AnimalPhotoFileName($command->photoName()),
                animalPhotoFilePath: new AnimalPhotoFilePath($command->photoPath()),
                animalPhotoFileExtension: new AnimalPhotoFileExtension($command->photoExtension()),
                animalPhotoFileMimeType: new AnimalPhotoFileMimeType($command->photoMimeType()),
            ),
        );
    }
}
