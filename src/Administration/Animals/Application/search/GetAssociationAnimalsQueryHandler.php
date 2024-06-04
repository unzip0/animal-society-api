<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Animals\Application\search;

use AnimalSociety\Administration\Animals\Application\AnimalsResponse;
use AnimalSociety\Shared\Domain\Bus\Query\QueryHandler;

final readonly class GetAssociationAnimalsQueryHandler implements QueryHandler
{
    public function __construct(
        private AnimalSearcher $searcher
    ) {}

    public function __invoke(GetAssociationAnimalsQuery $query): AnimalsResponse
    {
        return $this->searcher->search([
            'association_id' => $query->associationId(),
        ]);
    }
}
