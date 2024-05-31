<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\AnimalsSpecies\Domain;

use AnimalSociety\Shared\Domain\Aggregate\AggregateRoot;
use AnimalSociety\Shared\Domain\Mapper\Domain;

final class AnimalSpecies extends AggregateRoot implements Domain
{
    public function __construct(
        private readonly AnimalSpeciesId $animalSpeciesId,
        private readonly AnimalSpeciesName $animalSpeciesName,
    ) {}

    public static function create(
        AnimalSpeciesId $animalSpeciesId,
        AnimalSpeciesName $animalSpeciesName,
    ): self {
        $animalSpecies = new self(
            animalSpeciesId: $animalSpeciesId,
            animalSpeciesName: $animalSpeciesName,
        );

        return $animalSpecies;
    }

    public function animalSpeciesId(): AnimalSpeciesId
    {
        return $this->animalSpeciesId;
    }

    public function animalSpeciesName(): AnimalSpeciesName
    {
        return $this->animalSpeciesName;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->animalSpeciesId->value(),
            'name' => $this->animalSpeciesName->value(),
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
