<?php

declare(strict_types=1);

namespace App\Http\Controllers\Administration\Animals;

use AnimalSociety\Administration\Animals\Application\AnimalsResponse;
use AnimalSociety\Administration\Animals\Application\search\GetAssociationAnimalsQuery;
use AnimalSociety\Shared\Infrastructure\Http\ApiController;
use App\Http\Requests\BasicAuthRequest;
use Symfony\Component\HttpFoundation\Response;

final class AssociationAnimalsGetController extends ApiController
{
    public function __invoke(BasicAuthRequest $request): Response
    {
        /** @var AnimalsResponse $associationAnimals */
        $associationAnimals = $this->ask(
            new GetAssociationAnimalsQuery(
                associationId: $request->getAssociationId(),
            )
        );

        return $this->response($associationAnimals->toArray());
    }

    /**
     * @return array<string, int>
     */
    protected function exceptions(): array
    {
        return [];
    }
}
