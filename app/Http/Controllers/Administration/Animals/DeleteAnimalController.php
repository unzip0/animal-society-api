<?php

declare(strict_types=1);

namespace App\Http\Controllers\Administration\Animals;

use AnimalSociety\Administration\Animals\Application\delete\DeleteAnimalCommand;
use AnimalSociety\Shared\Infrastructure\Http\ApiController;
use App\Http\Requests\BasicAuthRequest;
use Symfony\Component\HttpFoundation\Response;

final class DeleteAnimalController extends ApiController
{
    public function __invoke(BasicAuthRequest $request, string $animalId): Response
    {
        $this->dispatch(
            new DeleteAnimalCommand(
                animaId: $animalId,
                associationId: $request->getAssociationId(),
            )
        );

        return new Response('', Response::HTTP_NO_CONTENT);
    }

    /**
     * @return array<string, int>
     */
    protected function exceptions(): array
    {
        return [];
    }
}
