<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\Application;

use AnimalSociety\Shared\Domain\Bus\Query\Response;

final class AnimalsResponse implements Response
{
    /**
     * @var AnimalResponse[]
     */
    private readonly array $animals;

    public function __construct(AnimalResponse ...$animals)
    {
        $this->animals = $animals;
    }

    /**
     * @return AnimalResponse[]
     */
    public function animals(): array
    {
        return $this->animals;
    }

    /**
     * @return array<array<string,mixed>>
     */
    public function toArray(): array
    {
        return array_map(
            fn (AnimalResponse $animal): array => [
                'id' => $animal->id(),
                'name' => $animal->name(),
                'species_id' => $animal->speciesId(),
                'race_id' => $animal->raceId(),
                'age' => $animal->age(),
                'available' => $animal->available(),
            ],
            $this->animals()
        );
    }
}
