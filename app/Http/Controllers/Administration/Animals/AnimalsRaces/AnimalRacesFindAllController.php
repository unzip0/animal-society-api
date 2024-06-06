<?php

declare(strict_types=1);

namespace App\Http\Controllers\Administration\Animals\AnimalsRaces;

use AnimalSociety\Administration\Animals\AnimalsRaces\Application\AnimalRacesResponse;
use AnimalSociety\Administration\Animals\AnimalsRaces\Application\findAll\FindAllAnimalRacesQuery;
use AnimalSociety\Shared\Infrastructure\Http\ApiController;
use Symfony\Component\HttpFoundation\Response;

final class AnimalRacesFindAllController extends ApiController
{
    public function __invoke(): Response
    {
        /** @var AnimalRacesResponse $animalRaces */
        $animalRaces = $this->ask(
            new FindAllAnimalRacesQuery()
        );

        return $this->response($animalRaces->toArray());
    }

    /**
     * @return array<string, int>
     */
    protected function exceptions(): array
    {
        return [];
    }
}
