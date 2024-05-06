<?php

declare(strict_types=1);

namespace App\Http\Controllers\Administration\Users;

use AnimalSociety\Administration\Users\Application\register\RegisterUserCommand;
use AnimalSociety\Shared\Infrastructure\Http\ApiController;
use App\Http\Requests\Administration\Users\UsersRegisterRequest;
use Symfony\Component\HttpFoundation\Response;

final class UsersRegisterController extends ApiController
{
    public function __invoke(UsersRegisterRequest $request): Response
    {
        $this->dispatch(
            new RegisterUserCommand(
                id: $request->getId(),
                name: $request->getName(),
                firstLastName: $request->getFirstLastName(),
                secondLastName: $request->getSecondLastName(),
                email: $request->getEmail(),
                password: $request->getPassword(),
                role: $request->getRole(),
                associationId: $request->getAssociationId(),
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
