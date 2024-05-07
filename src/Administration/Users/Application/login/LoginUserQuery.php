<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Application\login;

use AnimalSociety\Shared\Domain\Bus\Query\Query;

final readonly class LoginUserQuery implements Query
{
    public function __construct(
        private string $email,
        private string $password,
    ) {}

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }
}
