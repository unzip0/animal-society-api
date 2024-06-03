<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\AnimalPhotos\Domain;

use AnimalSociety\Administration\Animals\Domain\AnimalId;
use AnimalSociety\Shared\Domain\Aggregate\AggregateRoot;
use AnimalSociety\Shared\Domain\FileSystem\UploadedFile;

final class AnimalPhoto extends AggregateRoot implements UploadedFile
{
    public function __construct(
        private readonly AnimalId $animalId,
        private readonly AnimalPhotoFileName $animalPhotoFileName,
        private readonly AnimalPhotoFilePath $animalPhotoFilePath,
        private readonly AnimalPhotoFileExtension $animalPhotoFileExtension,
        private readonly AnimalPhotoFileMimeType $animalPhotoFileMimeType,
    ) {}

    public static function create(
        AnimalId $animalId,
        AnimalPhotoFileName $animalPhotoFileName,
        AnimalPhotoFilePath $animalPhotoFilePath,
        AnimalPhotoFileExtension $animalPhotoFileExtension,
        AnimalPhotoFileMimeType $animalPhotoFileMimeType,
    ): self {
        $animalPhoto = new self(
            animalId: $animalId,
            animalPhotoFileName: $animalPhotoFileName,
            animalPhotoFilePath: $animalPhotoFilePath,
            animalPhotoFileExtension: $animalPhotoFileExtension,
            animalPhotoFileMimeType: $animalPhotoFileMimeType,
        );

        return $animalPhoto;
    }

    public function animalId(): AnimalId
    {
        return $this->animalId;
    }

    public function animalPhotoFileName(): AnimalPhotoFileName
    {
        return $this->animalPhotoFileName;
    }

    public function animalPhotoFilePath(): AnimalPhotoFilePath
    {
        return $this->animalPhotoFilePath;
    }

    public function animalPhotoFileExtension(): AnimalPhotoFileExtension
    {
        return $this->animalPhotoFileExtension;
    }

    public function animalPhotoFileMimeType(): AnimalPhotoFileMimeType
    {
        return $this->animalPhotoFileMimeType;
    }

    public function getFileExtension(): string
    {
        return $this->animalPhotoFileExtension()->value();
    }

    public function getFileMimeType(): string
    {
        return $this->animalPhotoFileMimeType()->value();
    }

    public function getFileName(): string
    {
        return $this->animalPhotoFileName()->value();
    }

    public function getFilePath(): string
    {
        return $this->animalPhotoFilePath()->value();
    }

    public function getMediaModelId(): string
    {
        return $this->animalId()->value();
    }

    public function getMediaModelName(): string
    {
        return UploadedFile::MEDIA_ANIMAL;
    }
}
