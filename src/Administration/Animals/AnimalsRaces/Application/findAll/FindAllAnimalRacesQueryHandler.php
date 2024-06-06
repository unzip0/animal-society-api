<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\AnimalsRaces\Application\findAll;

use AnimalSociety\Administration\Animals\AnimalsRaces\Application\AnimalRacesResponse;
use AnimalSociety\Shared\Domain\Bus\Query\QueryHandler;

final readonly class FindAllAnimalRacesQueryHandler implements QueryHandler
{
    public function __construct(
        private AnimalRaceSearcher $searcher
    ) {}

    public function __invoke(FindAllAnimalRacesQuery $query): AnimalRacesResponse
    {
        return $this->searcher->searchAll();
    }
}
