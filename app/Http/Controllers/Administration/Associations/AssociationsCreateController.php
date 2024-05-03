<?php

declare(strict_types=1);

namespace App\Http\Controllers\Administration\Associations;

use AnimalSociety\Administration\Associations\Application\create\CreateAssociationCommand;
use AnimalSociety\Shared\Infrastructure\Http\ApiController;
use App\Http\Requests\Administration\Associations\AssociationsCreateRequest;
use Symfony\Component\HttpFoundation\Response;

final class AssociationsCreateController extends ApiController
{
    public function __invoke(AssociationsCreateRequest $request): Response
    {
        $this->dispatch(
            new CreateAssociationCommand(
                id: $request->getId(),
                cif: $request->getCif(),
                name: $request->getName(),
                cityId: $request->getCityId(),
                email: $request->getEmail(),
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
