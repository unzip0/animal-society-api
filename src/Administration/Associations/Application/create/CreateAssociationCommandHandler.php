<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Associations\Application\create;

use AnimalSociety\Administration\Associations\Domain\AssociationCif;
use AnimalSociety\Administration\Associations\Domain\AssociationCityId;
use AnimalSociety\Administration\Associations\Domain\AssociationEmail;
use AnimalSociety\Administration\Associations\Domain\AssociationId;
use AnimalSociety\Administration\Associations\Domain\AssociationName;
use AnimalSociety\Shared\Domain\Bus\Command\CommandHandler;

final readonly class CreateAssociationCommandHandler implements CommandHandler
{
    public function __construct(
        private AssociationCreator $creator
    ) {}

    public function __invoke(CreateAssociationCommand $command): void
    {
        $id = new AssociationId($command->id());
        $cif = new AssociationCif($command->cif());
        $name = new AssociationName($command->name());
        $cityId = new AssociationCityId($command->cityId());
        $email = new AssociationEmail($command->email());

        $this->creator->__invoke(
            id: $id->__toString(),
            cif: $cif->value(),
            name: $name->value(),
            cityId: $cityId->value(),
            email: $email->value(),
        );
    }
}
