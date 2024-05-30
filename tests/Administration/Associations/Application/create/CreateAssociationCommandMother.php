<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Associations\Application\create;

use AnimalSociety\Administration\Associations\Application\create\CreateAssociationCommand;
use AnimalSociety\Administration\Associations\Domain\AssociationCif;
use AnimalSociety\Administration\Associations\Domain\AssociationCityId;
use AnimalSociety\Administration\Associations\Domain\AssociationEmail;
use AnimalSociety\Administration\Associations\Domain\AssociationId;
use AnimalSociety\Administration\Associations\Domain\AssociationName;
use AnimalSociety\Tests\Administration\Associations\Domain\AssociationCifMother;
use AnimalSociety\Tests\Administration\Associations\Domain\AssociationCityIdMother;
use AnimalSociety\Tests\Administration\Associations\Domain\AssociationEmailMother;
use AnimalSociety\Tests\Administration\Associations\Domain\AssociationIdMother;
use AnimalSociety\Tests\Administration\Associations\Domain\AssociationNameMother;

final class CreateAssociationCommandMother
{
    public static function create(
        ?AssociationId $id = null,
        ?AssociationCif $cif = null,
        ?AssociationName $name = null,
        ?AssociationEmail $email = null,
        ?AssociationCityId $cityId = null,
    ): CreateAssociationCommand {
        return new CreateAssociationCommand(
            $id?->value() ?? AssociationIdMother::create()->value(),
            $cif?->value() ?? AssociationCifMother::create()->value(),
            $name?->value() ?? AssociationNameMother::create()->value(),
            $cityId?->value() ?? AssociationCityIdMother::create()->value(),
            $email?->value() ?? AssociationEmailMother::create()->value(),
        );
    }
}
