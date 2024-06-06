<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\AnimalsSpecies\Application\findAll;

use AnimalSociety\Administration\Animals\AnimalsSpecies\Application\AnimalsSpeciesResponse;
use AnimalSociety\Shared\Domain\Bus\Query\QueryHandler;

final readonly class FindAllAnimalSpeciesQueryHandler implements QueryHandler
{
    public function __construct(
        private AnimalSpeciesSearcher $searcher
    ) {}

    public function __invoke(FindAllAnimalSpeciesQuery $query): AnimalsSpeciesResponse
    {
        return $this->searcher->searchAll();
    }
}
