<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Application\findAll;

use AnimalSociety\Administration\Users\Application\UserResponse;
use AnimalSociety\Administration\Users\Application\UsersResponse;
use AnimalSociety\Administration\Users\Domain\User;
use AnimalSociety\Administration\Users\Domain\UserRepository;

use function Lambdish\Phunctional\map;

final readonly class UserSearcher
{
    public function __construct(
        private UserRepository $repository
    ) {}

    public function findAll(string $associationId): UsersResponse
    {
        return new UsersResponse(...map(
            $this->toResponse(),
            $this->repository->matchingByCriteria([
                'association_id' => $associationId,
            ])
        ));
    }

    private function toResponse(): callable
    {
        return static fn (User $user): UserResponse => new UserResponse(
            $user->id()->__toString(),
            $user->name()->value(),
            $user->firstLastName()->value(),
            $user->secondLastName()->value(),
            $user->email()->value(),
            $user->role()->value(),
            $user->isActive()
        );
    }
}
