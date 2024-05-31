<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\AnimalPhotos\Domain;

use AnimalSociety\Administration\Animals\Domain\AnimalId;
use AnimalSociety\Shared\Domain\Aggregate\AggregateRoot;
use AnimalSociety\Shared\Domain\Mapper\Domain;

final class AnimalPhoto extends AggregateRoot implements Domain
{
    public function __construct(
        private readonly AnimalPhotoId $animalPhotoId,
        private readonly AnimalId $animalId,
        private readonly AnimalPhotoFileName $animalPhotoFileName,
        private readonly AnimalPhotoFilePath $animalPhotoFilePath,
        private readonly AnimalPhotoFileExtension $animalPhotoFileExtension,
        private readonly AnimalPhotoFileMimeType $animalPhotoFileMimeType,
        private readonly AnimalPhotoUrl $animalPhotoUrl,
    ) {}

    public static function create(
        AnimalPhotoId $animalPhotoId,
        AnimalId $animalId,
        AnimalPhotoFileName $animalPhotoFileName,
        AnimalPhotoFilePath $animalPhotoFilePath,
        AnimalPhotoFileExtension $animalPhotoFileExtension,
        AnimalPhotoFileMimeType $animalPhotoFileMimeType,
        AnimalPhotoUrl $animalPhotoUrl,
    ): self {
        $animaleRace = new self(
            animalPhotoId: $animalPhotoId,
            animalId: $animalId,
            animalPhotoFileName: $animalPhotoFileName,
            animalPhotoFilePath: $animalPhotoFilePath,
            animalPhotoFileExtension: $animalPhotoFileExtension,
            animalPhotoFileMimeType: $animalPhotoFileMimeType,
            animalPhotoUrl: $animalPhotoUrl,
        );

        return $animaleRace;
    }

    public function animalPhotoId(): AnimalPhotoId
    {
        return $this->animalPhotoId;
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

    public function animalPhotoUrl(): AnimalPhotoUrl
    {
        return $this->animalPhotoUrl;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->animalPhotoId->value(),
            'animal_id' => $this->animalId->value(),
            'file_name' => $this->animalPhotoFileName->value(),
            'file_path' => $this->animalPhotoFilePath->value(),
            'file_extension' => $this->animalPhotoFileExtension->value(),
            'file_mime_type' => $this->animalPhotoFileMimeType->value(),
            'url' => $this->animalPhotoUrl->value(),
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function transform(): array
    {
        return $this->toArray();
    }
}
