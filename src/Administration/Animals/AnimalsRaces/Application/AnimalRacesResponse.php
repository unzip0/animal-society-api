<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\AnimalsRaces\Application;

use AnimalSociety\Shared\Domain\Bus\Query\Response;

final class AnimalRacesResponse implements Response
{
    /**
     * @var AnimalRaceResponse[]
     */
    private readonly array $animalRaces;

    public function __construct(AnimalRaceResponse ...$animalRaces)
    {
        $this->animalRaces = $animalRaces;
    }

    /**
     * @return AnimalRaceResponse[]
     */
    public function animalRaces(): array
    {
        return $this->animalRaces;
    }

    /**
     * @return array<array<string,mixed>>
     */
    public function toArray(): array
    {
        return array_reduce(
            $this->animalRaces(),
            function (array $carry, AnimalRaceResponse $animalRace): array {
                $carry[$animalRace->id()] = [
                    'name' => $animalRace->name(),
                    'species_id' => $animalRace->speciesId(),
                ];
                return $carry;
            },
            []
        );
    }
}
