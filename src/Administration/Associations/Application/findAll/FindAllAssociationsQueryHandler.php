<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Associations\Application\findAll;

use AnimalSociety\Administration\Associations\Application\AssociationsResponse;
use AnimalSociety\Shared\Domain\Bus\Query\QueryHandler;

final readonly class FindAllAssociationsQueryHandler implements QueryHandler
{
    public function __construct(
        private AssociationSearcher $searcher
    ) {}

    public function __invoke(FindAllAssociationsQuery $query): AssociationsResponse
    {
        return $this->searcher->findAll();
    }
}
