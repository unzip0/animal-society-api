<?php

declare(strict_types=1);

namespace App\Http\Controllers\Administration\Animals\AnimalsSpecies;

use AnimalSociety\Administration\Animals\AnimalsSpecies\Application\create\CreateAnimalSpeciesCommand;
use AnimalSociety\Shared\Infrastructure\Http\ApiController;
use App\Http\Requests\Administration\Animals\AnimalsSpecies\AnimalsSpeciesCreateRequest;
use Symfony\Component\HttpFoundation\Response;

final class AnimalSpeciesCreateController extends ApiController
{
    public function __invoke(AnimalsSpeciesCreateRequest $request): Response
    {
        $this->dispatch(
            new CreateAnimalSpeciesCommand(
                id: $request->getId(),
                name: $request->getName(),
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
