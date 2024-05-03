<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Associations\Application\find;

use AnimalSociety\Administration\Associations\Domain\Association;
use AnimalSociety\Administration\Associations\Domain\AssociationRepository;
use AnimalSociety\Shared\Domain\Criteria\Criteria;

final readonly class AssociationFinder
{
    public function __construct(
        private AssociationRepository $repository
    ) {}

    /**
     * @return Association[]
     */
    public function __invoke(Criteria $criteria): array
    {
        return $this->repository->matching($criteria);
    }
}
