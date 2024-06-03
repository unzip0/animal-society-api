<?php

declare(strict_types=1);

namespace App\Http\Controllers\Administration\Animals;

use AnimalSociety\Administration\Animals\Application\create\CreateAnimalCommand;
use AnimalSociety\Shared\Infrastructure\Http\ApiController;
use App\Http\Requests\Administration\Animals\AnimalCreateRequest;
use Symfony\Component\HttpFoundation\Response;

final class AnimalCreateController extends ApiController
{
    public function __invoke(AnimalCreateRequest $request): Response
    {
        $this->dispatch(
            new CreateAnimalCommand(
                id: $request->getId(),
                associationId: $request->getAssociationId(),
                name: $request->getName(),
                speciesId: $request->getSpeciesId(),
                raceId: $request->getRaceId(),
                age: $request->getAge(),
                photoPath: $request->getPhoto()->getPathname(),
                photoName: $request->getPhoto()->getClientOriginalName(),
                photoMimeType: $request->getPhoto()->getClientMimeType(),
                photoExtension: $request->getPhoto()->getClientOriginalExtension(),
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
