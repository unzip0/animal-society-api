<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Associations\Application\create;

use AnimalSociety\Administration\Associations\Application\find\AssociationFinder;
use AnimalSociety\Administration\Associations\Domain\Association;
use AnimalSociety\Administration\Associations\Domain\AssociationRepository;
use AnimalSociety\Administration\Associations\Domain\Exception\AssociationCifAlreadyExistsException;
use AnimalSociety\Administration\Associations\Domain\Exception\AssociationEmailInvalidException;
use AnimalSociety\Shared\Domain\Bus\Event\EventBus;

final readonly class AssociationCreator
{
    public function __construct(
        private AssociationRepository $repository,
        private AssociationFinder $associationFinder,
        // private EventBus $bus,
    ) {}

    public function __invoke(
        string $id,
        string $cif,
        string $name,
        int $cityId,
        string $email,
    ): void {
        $association = Association::create(
            associationId: $id,
            associationCif: $cif,
            associationName: $name,
            associationCityId: $cityId,
            associationEmail: $email,
        );

        $this->checkAssociationConstraints($association);

        $this->repository->save($association);

        // $this->bus->publish(...$association->pullDomainEvents());
    }

    private function checkAssociationConstraints(Association $association): void
    {
        $associationWithSameCif = $this->associationFinder->__invoke([
            'associationCif' => $association->associationCif(),
        ]);

        if ($associationWithSameCif instanceof Association) {
            throw AssociationCifAlreadyExistsException::create();
        }

        $associationWithSameEmail = $this->associationFinder->__invoke([
            'associationEmail' => $association->associationEmail(),
        ]);

        if ($associationWithSameEmail instanceof Association) {
            throw AssociationEmailInvalidException::create();
        }
    }
}
