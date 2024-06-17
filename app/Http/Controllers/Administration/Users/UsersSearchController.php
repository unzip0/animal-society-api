<?php

declare(strict_types=1);

namespace App\Http\Controllers\Administration\Users;

use AnimalSociety\Administration\Users\Application\findAll\FindAllUsersQuery;
use AnimalSociety\Administration\Users\Application\UsersResponse;
use AnimalSociety\Shared\Infrastructure\Http\ApiController;
use App\Http\Requests\BasicAuthRequest;
use Symfony\Component\HttpFoundation\JsonResponse;

final class UsersSearchController extends ApiController
{
    public function __invoke(BasicAuthRequest $request): JsonResponse
    {
        /** @var UsersResponse $usersResponse */
        $usersResponse = $this->ask(new FindAllUsersQuery(
            associationId: $request->getAssociationId()
        ));

        return $this->response($usersResponse->toArray());
    }

    /**
     * @return array<string, int>
     */
    protected function exceptions(): array
    {
        return [];
    }
}
