<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Animals\AnimalSpecies\Domain;

use AnimalSociety\Administration\Animals\AnimalsSpecies\Application\create\CreateAnimalSpeciesCommand;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpecies;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpeciesId;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpeciesName;

final class AnimalSpeciesMother
{
    public static function create(
        ?AnimalSpeciesId $id = null,
        ?AnimalSpeciesName $name = null,
    ): AnimalSpecies {
        return new AnimalSpecies(
            $id ?? AnimalSpeciesIdMother::create(),
            $name ?? AnimalSpeciesNameMother::create(),
        );
    }

    public static function fromRequest(CreateAnimalSpeciesCommand $request): AnimalSpecies
    {
        return self::create(
            AnimalSpeciesIdMother::create($request->id()),
            AnimalSpeciesNameMother::create($request->name()),
        );
    }
}
