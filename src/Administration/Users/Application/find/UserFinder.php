<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Application\find;

use AnimalSociety\Administration\Users\Domain\User;
use AnimalSociety\Administration\Users\Domain\UserRepository;

final readonly class UserFinder
{
    public function __construct(
        private UserRepository $repository
    ) {}

    /**
     * @param array<string,mixed> $criteria
     */
    public function __invoke(array $criteria): ?User
    {
        return $this->repository->findOneBy($criteria);
    }
}
