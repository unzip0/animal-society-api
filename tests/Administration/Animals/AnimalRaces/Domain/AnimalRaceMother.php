<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Animals\AnimalRaces\Domain;

use AnimalSociety\Administration\Animals\AnimalsRaces\Application\create\CreateAnimalRaceCommand;
use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\AnimalRace;
use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\AnimalRaceId;
use AnimalSociety\Administration\Animals\AnimalsRaces\Domain\AnimalRaceName;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Domain\AnimalSpeciesId;
use AnimalSociety\Tests\Administration\Animals\AnimalSpecies\Domain\AnimalSpeciesIdMother;

final class AnimalRaceMother
{
    public static function create(
        ?AnimalRaceId $id = null,
        ?AnimalRaceName $name = null,
        ?AnimalSpeciesId $speciesId = null,
    ): AnimalRace {
        return new AnimalRace(
            $id ?? AnimalRaceIdMother::create(),
            $name ?? AnimalRaceNameMother::create(),
            $speciesId ?? AnimalSpeciesIdMother::create(),
        );
    }

    public static function fromRequest(CreateAnimalRaceCommand $request): AnimalRace
    {
        return self::create(
            AnimalRaceIdMother::create($request->id()),
            AnimalRaceNameMother::create($request->name()),
            AnimalSpeciesIdMother::create($request->speciesId()),
        );
    }
}
