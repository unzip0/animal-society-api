<?php

declare(strict_types=1);

namespace App\Http\Controllers\Administration\Animals\AnimalsRaces;

use AnimalSociety\Administration\Animals\AnimalsRaces\Application\create\CreateAnimalRaceCommand;
use AnimalSociety\Shared\Infrastructure\Http\ApiController;
use App\Http\Requests\Administration\Animals\AnimalsRaces\AnimalsRacesCreateRequest;
use Symfony\Component\HttpFoundation\Response;

final class AnimalRacesCreateController extends ApiController
{
    public function __invoke(AnimalsRacesCreateRequest $request): Response
    {
        $this->dispatch(
            new CreateAnimalRaceCommand(
                id: $request->getId(),
                name: $request->getName(),
                speciesId: $request->getSpeciesId(),
            )
        );

        return new Response('', Response::HTTP_CREATED);
    }

    /**
     * @return array<string, int>
     */
    protected function exceptions(): array
    {
        return [];
    }
}
