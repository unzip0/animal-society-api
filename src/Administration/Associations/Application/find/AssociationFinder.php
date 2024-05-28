<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Associations\Application\find;

use AnimalSociety\Administration\Associations\Domain\AssociationRepository;
use AnimalSociety\Shared\Domain\Mapper\Domain;

final readonly class AssociationFinder
{
    public function __construct(
        private AssociationRepository $repository
    ) {}

    /**
     * @param array<string,mixed> $criteria
     */
    public function __invoke(array $criteria): ?Domain
    {
        return $this->repository->findOneBy($criteria);
    }
}
