<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Application\update;

use AnimalSociety\Administration\Users\Domain\Exception\UserNotFoundException;
use AnimalSociety\Administration\Users\Domain\User;
use AnimalSociety\Administration\Users\Domain\UserFirstLastName;
use AnimalSociety\Administration\Users\Domain\UserId;
use AnimalSociety\Administration\Users\Domain\UserName;
use AnimalSociety\Administration\Users\Domain\UserRepository;
use AnimalSociety\Administration\Users\Domain\UserSecondLastName;
use AnimalSociety\Shared\Domain\Exception\Auth\UserStatusException;

final readonly class UserUpdate
{
    public function __construct(
        private UserRepository $repository,
    ) {}

    public function __invoke(
        string $id,
        string $name,
        string $firstLastName,
        string $secondLastName,
    ): void {
        $user = $this->repository->findById(
            new UserId($id)
        );
        if (!$user instanceof User) {
            throw UserNotFoundException::create();
        }

        if (!$user->isActive()) {
            throw UserStatusException::create();
        }

        $user->updateName(new UserName($name));
        $user->updateFirstLastName(new UserFirstLastName($firstLastName));
        $user->updateSecondLastName(new UserSecondLastName($secondLastName));

        $this->repository->updateUser($user);
    }
}
