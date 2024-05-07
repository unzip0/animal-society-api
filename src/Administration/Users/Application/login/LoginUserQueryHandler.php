<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Application\login;

use AnimalSociety\Administration\Users\Application\UserLoginResponse;
use AnimalSociety\Administration\Users\Domain\UserEmail;
use AnimalSociety\Administration\Users\Domain\UserPassword;
use AnimalSociety\Shared\Domain\Bus\Query\QueryHandler;

final readonly class LoginUserQueryHandler implements QueryHandler
{
    public function __construct(
        private UserLogin $login
    ) {}

    public function __invoke(LoginUserQuery $query): UserLoginResponse
    {
        $email = new UserEmail($query->email());
        $password = new UserPassword($query->password());

        return $this->login->__invoke(
            email: $email->value(),
            password: $password->value(),
        );
    }
}
