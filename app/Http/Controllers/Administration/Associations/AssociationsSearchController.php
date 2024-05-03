<?php

declare(strict_types=1);

namespace App\Http\Controllers\Administration\Associations;

use AnimalSociety\Administration\Associations\Application\AssociationsResponse;
use AnimalSociety\Administration\Associations\Application\findAll\FindAllAssociationsQuery;
use AnimalSociety\Shared\Infrastructure\Http\ApiController;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

final class AssociationsSearchController extends ApiController
{
    public function __invoke(Request $request): JsonResponse
    {
        /** @var AssociationsResponse $associationsResponse */
        $associationsResponse = $this->ask(new FindAllAssociationsQuery());

        return new JsonResponse($associationsResponse->toArray());
    }

    /**
     * @return array<string, int>
     */
    protected function exceptions(): array
    {
        return [];
    }
}
