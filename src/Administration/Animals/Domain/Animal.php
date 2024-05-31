<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\Domain;

use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpeciesId;
use AnimalSociety\Shared\Domain\Aggregate\AggregateRoot;
use AnimalSociety\Shared\Domain\Mapper\Domain;

final class Animal extends AggregateRoot implements Domain
{
    public function __construct(
        private readonly AnimalId $animalId,
        private readonly AnimalAssociationId $animalAssociationId,
        private readonly AnimalName $animalName,
        private readonly AnimalSpeciesId $animalSpeciesId,
        private readonly AnimalRaceId $animalRaceId,
        private readonly AnimalAge $animalAge,
        private readonly bool $animalAvailable,
    ) {}

    public static function create(
        AnimalId $animalId,
        AnimalAssociationId $animalAssociationId,
        AnimalName $animalName,
        AnimalSpeciesId $animalSpeciesId,
        AnimalRaceId $animalRaceId,
        AnimalAge $animalAge,
    ): self {
        $animal = new self(
            animalId: $animalId,
            animalAssociationId: $animalAssociationId,
            animalName: $animalName,
            animalSpeciesId: $animalSpeciesId,
            animalRaceId: $animalRaceId,
            animalAge: $animalAge,
            animalAvailable: true,
        );

        return $animal;
    }

    public function animalId(): AnimalId
    {
        return $this->animalId;
    }

    public function animalAssociationId(): AnimalAssociationId
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

    public function isAvailable(): bool
    {
        return $this->animalAvailable === true;
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
