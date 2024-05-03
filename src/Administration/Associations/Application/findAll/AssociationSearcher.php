<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Associations\Application\findAll;

use AnimalSociety\Administration\Associations\Application\AssociationResponse;
use AnimalSociety\Administration\Associations\Application\AssociationsResponse;
use AnimalSociety\Administration\Associations\Domain\Association;
use AnimalSociety\Administration\Associations\Domain\AssociationRepository;

use function Lambdish\Phunctional\map;

final readonly class AssociationSearcher
{
    public function __construct(
        private AssociationRepository $repository
    ) {}

    public function findAll(): AssociationsResponse
    {
        return new AssociationsResponse(...map($this->toResponse(), $this->repository->findAll()));
    }

    private function toResponse(): callable
    {
        return static fn (Association $association): AssociationResponse => new AssociationResponse(
            $association->id(),
            $association->associationCif(),
            $association->associationName(),
            $association->associationEmail(),
            $association->associationCityId()
        );
    }
}
