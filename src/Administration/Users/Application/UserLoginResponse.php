<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Application;

use AnimalSociety\Administration\Users\Domain\User;
use AnimalSociety\Shared\Domain\Bus\Query\Response;

final class UserLoginResponse implements Response
{
    public function __construct(
        private User $user,
        private string $token,
    ) {}

    public function user(): User
    {
        return $this->user;
    }

    public function token(): string
    {
        return $this->token;
    }

    /**
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        return [
            'user' => $this->user()->toArray(),
            'access_token' => [
                'token' => $this->token(),
                'type' => 'Bearer',
                /**
                 * @phpstan-ignore-next-line
                 */
                'expires_in' => auth()->factory()->getTTL() * 60,
            ],
        ];
    }
}
