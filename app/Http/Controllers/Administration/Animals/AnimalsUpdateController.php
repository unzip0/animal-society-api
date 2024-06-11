<?php

declare(strict_types=1);

namespace App\Http\Controllers\Administration\Animals;

use AnimalSociety\Administration\Animals\Application\update\UpdateAnimalCommand;
use AnimalSociety\Shared\Infrastructure\Http\ApiController;
use App\Http\Requests\Administration\Animals\AnimalUpdateRequest;
use Symfony\Component\HttpFoundation\Response;

final class AnimalsUpdateController extends ApiController
{
    public function __invoke(AnimalUpdateRequest $request, string $animalId): Response
    {
        $this->dispatch(
            new UpdateAnimalCommand(
                id: $animalId,
                associationId: $request->getAssociationId(),
                name: $request->getName(),
                speciesId: $request->getSpeciesId(),
                raceId: $request->getRaceId(),
                age: $request->getAge(),
                photoPath: $request->getPhoto()?->getPathname(),
                photoName: $request->getPhoto()?->getClientOriginalName(),
                photoMimeType: $request->getPhoto()?->getClientMimeType(),
                photoExtension: $request->getPhoto()?->getClientOriginalExtension(),
            )
        );

        return new Response('', Response::HTTP_OK);
    }

    /**
     * @return array<string, int>
     */
    protected function exceptions(): array
    {
        return [];
    }
}
