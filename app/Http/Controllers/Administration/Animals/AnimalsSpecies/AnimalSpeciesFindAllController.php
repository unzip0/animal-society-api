<?php

declare(strict_types=1);

namespace App\Http\Controllers\Administration\Animals\AnimalsSpecies;

use AnimalSociety\Administration\Animals\AnimalsSpecies\Application\AnimalsSpeciesResponse;
use AnimalSociety\Administration\Animals\AnimalsSpecies\Application\findAll\FindAllAnimalSpeciesQuery;
use AnimalSociety\Shared\Infrastructure\Http\ApiController;
use Symfony\Component\HttpFoundation\Response;

final class AnimalSpeciesFindAllController extends ApiController
{
    public function __invoke(): Response
    {
        /** @var AnimalsSpeciesResponse $animalSpecies */
        $animalSpecies = $this->ask(
            new FindAllAnimalSpeciesQuery()
        );

        return $this->response($animalSpecies->toArray());
    }

    /**
     * @return array<string, int>
     */
    protected function exceptions(): array
    {
        return [];
    }
}
