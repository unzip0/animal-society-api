<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Associations\Application\find;

use AnimalSociety\Administration\Associations\Domain\Association;
use AnimalSociety\Administration\Associations\Domain\AssociationRepository;

final readonly class AssociationFinder
{
    public function __construct(
        private AssociationRepository $repository
    ) {}

    /**
     * @param array<string,mixed> $criteria
     */
    public function __invoke(array $criteria): ?Association
    {
        return $this->repository->findOneBy($criteria);
    }
}
