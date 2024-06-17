<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Application;

use AnimalSociety\Shared\Domain\Bus\Query\Response;

final class UsersResponse implements Response
{
    /**
     * @var UserResponse[]
     */
    private readonly array $users;

    public function __construct(UserResponse ...$users)
    {
        $this->users = $users;
    }

    /**
     * @return UserResponse[]
     */
    public function users(): array
    {
        return $this->users;
    }

    /**
     * @return array<array<string,mixed>>
     */
    public function toArray(): array
    {
        return array_map(
            fn (UserResponse $user): array => [
                'id' => $user->id(),
                'name' => $user->name(),
                'first_last_name' => $user->firstLastName(),
                'second_last_name' => $user->secondLastName(),
                'email' => $user->email(),
                'role' => $user->role(),
                'active' => $user->active(),
            ],
            $this->users()
        );
    }
}
