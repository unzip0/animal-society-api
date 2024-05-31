<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\AnimalsRaces\Domain;

use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpeciesId;
use AnimalSociety\Shared\Domain\Aggregate\AggregateRoot;
use AnimalSociety\Shared\Domain\Mapper\Domain;

final class AnimalRace extends AggregateRoot implements Domain
{
    public function __construct(
        private readonly AnimalRaceId $animalRaceId,
        private readonly AnimalRaceName $animalRaceName,
        private readonly AnimalSpeciesId $animalSpeciesId,
    ) {}

    public static function create(
        AnimalRaceId $animalRaceId,
        AnimalRaceName $animalRaceName,
        AnimalSpeciesId $animalSpeciesId,
    ): self {
        $animaleRace = new self(
            animalRaceId: $animalRaceId,
            animalRaceName: $animalRaceName,
            animalSpeciesId: $animalSpeciesId,
        );

        return $animaleRace;
    }

    public function animalRaceId(): AnimalRaceId
    {
        return $this->animalRaceId;
    }

    public function animalRaceName(): AnimalRaceName
    {
        return $this->animalRaceName;
    }

    public function animalSpeciesId(): AnimalSpeciesId
    {
        return $this->animalSpeciesId;
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->animalRaceId->value(),
            'name' => $this->animalRaceName->value(),
            'species_id' => $this->animalSpeciesId->value(),
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
