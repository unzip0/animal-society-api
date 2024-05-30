<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Associations\Application\create;

use AnimalSociety\Administration\Associations\Domain\Association;
use AnimalSociety\Administration\Associations\Domain\AssociationCif;
use AnimalSociety\Administration\Associations\Domain\AssociationCityId;
use AnimalSociety\Administration\Associations\Domain\AssociationEmail;
use AnimalSociety\Administration\Associations\Domain\AssociationId;
use AnimalSociety\Administration\Associations\Domain\AssociationName;
use AnimalSociety\Administration\Associations\Domain\AssociationRepository;
use AnimalSociety\Administration\Associations\Domain\Exception\AssociationCifAlreadyExistsException;
use AnimalSociety\Administration\Associations\Domain\Exception\AssociationEmailInvalidException;
use AnimalSociety\Shared\Domain\Bus\Event\EventBus;

final readonly class AssociationCreator
{
    public function __construct(
        private AssociationRepository $repository,
        private EventBus $bus,
    ) {}

    public function __invoke(
        string $id,
        string $cif,
        string $name,
        int $cityId,
        string $email,
    ): void {
        $association = Association::create(
            associationId: new AssociationId($id),
            associationCif: new AssociationCif($cif),
            associationName: new AssociationName($name),
            associationCityId: new AssociationCityId($cityId),
            associationEmail: new AssociationEmail($email),
        );

        $this->checkAssociationConstraints($association);

        $this->repository->create($association);

        $this->bus->publish(...$association->pullDomainEvents());
    }

    private function checkAssociationConstraints(Association $association): void
    {
        $associationWithSameCif = $this->repository->findOneBy(
            [
                'cif' => $association->associationCif()->value(),
            ]
        );

        if ($associationWithSameCif instanceof Association) {
            throw AssociationCifAlreadyExistsException::create();
        }

        $associationWithSameEmail = $this->repository->findOneBy(
            [
                'email' => $association->associationEmail()->value(),
            ]
        );

        if ($associationWithSameEmail instanceof Association) {
            throw AssociationEmailInvalidException::create();
        }
    }
}
