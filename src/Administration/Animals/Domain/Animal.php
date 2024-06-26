<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\Domain;

use AnimalSociety\Administration\Animals\AnimalPhotos\Domain\AnimalPhoto;
use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\AnimalRaceId;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpeciesId;
use AnimalSociety\Administration\Associations\Domain\AssociationId;
use AnimalSociety\Shared\Domain\Aggregate\AggregateRoot;
use AnimalSociety\Shared\Domain\Mapper\Domain;

final class Animal extends AggregateRoot implements Domain
{
    public function __construct(
        private readonly AnimalId $animalId,
        private readonly AssociationId $animalAssociationId,
        private AnimalName $animalName,
        private AnimalSpeciesId $animalSpeciesId,
        private AnimalRaceId $animalRaceId,
        private AnimalAge $animalAge,
        private ?AnimalPhoto $animalPhoto,
        private readonly bool $animalAvailable,
    ) {}

    public static function create(
        AnimalId $animalId,
        AssociationId $animalAssociationId,
        AnimalName $animalName,
        AnimalSpeciesId $animalSpeciesId,
        AnimalRaceId $animalRaceId,
        AnimalAge $animalAge,
        ?AnimalPhoto $animalPhoto,
    ): self {
        $animal = new self(
            animalId: $animalId,
            animalAssociationId: $animalAssociationId,
            animalName: $animalName,
            animalSpeciesId: $animalSpeciesId,
            animalRaceId: $animalRaceId,
            animalAge: $animalAge,
            animalPhoto: $animalPhoto,
            animalAvailable: true,
        );

        return $animal;
    }

    public function animalId(): AnimalId
    {
        return $this->animalId;
    }

    public function animalAssociationId(): AssociationId
    {
        return $this->animalAssociationId;
    }

    public function animalName(): AnimalName
    {
        return $this->animalName;
    }

    public function animalSpeciesId(): AnimalSpeciesId
    {
        return $this->animalSpeciesId;
    }

    public function animalRaceId(): AnimalRaceId
    {
        return $this->animalRaceId;
    }

    public function animalAge(): AnimalAge
    {
        return $this->animalAge;
    }

    public function animalPhoto(): ?AnimalPhoto
    {
        return $this->animalPhoto;
    }

    public function isAvailable(): bool
    {
        return $this->animalAvailable === true;
    }

    public function updateName(AnimalName $animalName): void
    {
        $this->animalName = $animalName;
    }

    public function updateSpecies(AnimalSpeciesId $animalSpeciesId): void
    {
        $this->animalSpeciesId = $animalSpeciesId;
    }

    public function updateRace(AnimalRaceId $animalRaceId): void
    {
        $this->animalRaceId = $animalRaceId;
    }

    public function updateAge(AnimalAge $animalAge): void
    {
        $this->animalAge = $animalAge;
    }

    public function updatePhoto(AnimalPhoto $animalPhoto): void
    {
        $this->animalPhoto = $animalPhoto;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->animalId->value(),
            'association_id' => $this->animalAssociationId->value(),
            'name' => $this->animalName->value(),
            'species_id' => $this->animalSpeciesId->value(),
            'race_id' => $this->animalRaceId->value(),
            'age' => $this->animalAge->value(),
            'available' => $this->isAvailable(),
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
