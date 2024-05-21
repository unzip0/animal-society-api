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
        UserId $id,
        UserName $name,
        UserFirstLastName $firstLastName,
        UserSecondLastName $secondLastName,
    ): void {
        $user = $this->repository->find($id);
        if (!$user instanceof User) {
            throw UserNotFoundException::create();
        }

        if (!$user->isActive()) {
            throw UserStatusException::create();
        }

        $user->updateName($name->value());
        $user->updateFirstLastName($firstLastName->value());
        $user->updateSecondLastName($secondLastName->value());

        $this->repository->save($user);
    }
}
