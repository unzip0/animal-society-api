<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Associations\Domain;

use AnimalSociety\Administration\Associations\Application\create\CreateAssociationCommand;
use AnimalSociety\Administration\Associations\Domain\Association;
use AnimalSociety\Administration\Associations\Domain\AssociationCif;
use AnimalSociety\Administration\Associations\Domain\AssociationCityId;
use AnimalSociety\Administration\Associations\Domain\AssociationEmail;
use AnimalSociety\Administration\Associations\Domain\AssociationId;
use AnimalSociety\Administration\Associations\Domain\AssociationName;

final class AssociationMother
{
    public static function create(
        ?AssociationId $id = null,
        ?AssociationCif $cif = null,
        ?AssociationName $name = null,
        ?AssociationEmail $email = null,
        ?AssociationCityId $cityId = null,
    ): Association {
        return new Association(
            $id ?? AssociationIdMother::create(),
            $cif ?? AssociationCifMother::create(),
            $name ?? AssociationNameMother::create(),
            $cityId ?? AssociationCityIdMother::create(),
            $email ?? AssociationEmailMother::create(),
            true
        );
    }

    public static function fromRequest(CreateAssociationCommand $request): Association
    {
        return self::create(
            AssociationIdMother::create($request->id()),
            AssociationCifMother::create($request->cif()),
            AssociationNameMother::create($request->name()),
            AssociationEmailMother::create($request->email()),
            AssociationCityIdMother::create($request->cityId()),
        );
    }
}
