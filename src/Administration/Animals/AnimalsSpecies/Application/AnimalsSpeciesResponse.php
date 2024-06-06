<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\AnimalsSpecies\Application;

use AnimalSociety\Shared\Domain\Bus\Query\Response;

final class AnimalsSpeciesResponse implements Response
{
    /**
     * @var AnimalSpeciesResponse[]
     */
    private readonly array $animalSpecies;

    public function __construct(AnimalSpeciesResponse ...$animalSpecies)
    {
        $this->animalSpecies = $animalSpecies;
    }

    /**
     * @return AnimalSpeciesResponse[]
     */
    public function animalSpecies(): array
    {
        return $this->animalSpecies;
    }

    /**
     * @return array<array<string,mixed>>
     */
    public function toArray(): array
    {
        return array_reduce(
            $this->animalSpecies(),
            function (array $carry, AnimalSpeciesResponse $animalSpecies): array {
                $carry[$animalSpecies->id()] = [
                    'name' => $animalSpecies->name(),
                ];
                return $carry;
            },
            []
        );
    }
}
