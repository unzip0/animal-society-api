<?php

declare(strict_types=1);

namespace App\Http\Controllers\Administration\Users;

use AnimalSociety\Administration\Users\Application\login\LoginUserQuery;
use AnimalSociety\Administration\Users\Application\UserLoginResponse;
use AnimalSociety\Shared\Infrastructure\Http\ApiController;
use App\Http\Requests\Administration\Users\UserLoginRequest;
use Symfony\Component\HttpFoundation\Response;

final class UsersLoginController extends ApiController
{
    public function __invoke(UserLoginRequest $request): Response
    {
        /** @var UserLoginResponse $userInfo */

        $userInfo = $this->ask(
            new LoginUserQuery(
                email: $request->getEmail(),
                password: $request->getPassword(),
            )
        );

        return $this->response($userInfo->toArray());
    }

    /**
     * @return array<string, int>
     */
    protected function exceptions(): array
    {
        return [];
    }
}
