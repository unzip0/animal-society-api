<?php

declare(strict_types=1);

namespace App\Http\Controllers\Administration\Users;

use AnimalSociety\Administration\Users\Application\update\UpdateUserCommand;
use AnimalSociety\Shared\Infrastructure\Http\ApiController;
use App\Http\Requests\Administration\Users\UsersUpdateRequest;
use Symfony\Component\HttpFoundation\Response;

final class UsersUpdateController extends ApiController
{
    public function __invoke(UsersUpdateRequest $request, string $userId): Response
    {
        $this->dispatch(
            new UpdateUserCommand(
                id: $userId,
                name: $request->getName(),
                firstLastName: $request->getFirstLastName(),
                secondLastName: $request->getSecondLastName(),
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
