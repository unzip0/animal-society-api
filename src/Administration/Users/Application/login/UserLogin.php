<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Application\login;

use AnimalSociety\Administration\Users\Application\UserLoginResponse;
use AnimalSociety\Administration\Users\Domain\User;
use AnimalSociety\Administration\Users\Domain\UserRepository;
use AnimalSociety\Shared\Domain\Exception\Auth\UserInvalidCredentialsException;
use AnimalSociety\Shared\Domain\Exception\Auth\UserStatusException;

final readonly class UserLogin
{
    public function __construct(
        private UserRepository $repository,
    ) {}

    public function __invoke(
        string $email,
        string $password,
    ): UserLoginResponse {
        /**
         * @phpstan-ignore-next-line
         */
        $token = auth()->attempt([
            'email' => $email,
            'password' => $password,
        ]);

        if (!$token) {
            throw UserInvalidCredentialsException::create();
        }

        /** @var User $user */
        $user = $this->repository->findOneBy([
            'email' => $email,
        ]);

        if (!$user->isActive()) {
            throw UserStatusException::create();
        }

        return new UserLoginResponse(
            user: $user,
            token: (string) $token,
        );
    }
}
