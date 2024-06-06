<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Animals\Application\search;

use AnimalSociety\Administration\Animals\Application\AnimalResponse;
use AnimalSociety\Administration\Animals\Application\AnimalsResponse;

final class AnimalsResponseMother
{
    public static function create(
        ?AnimalResponse $animalResponse = null,
    ): AnimalsResponse {
        return new AnimalsResponse(
            $animalResponse ?? AnimalResponseMother::create(),
        );
    }
}
