<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Application\find;

use AnimalSociety\Administration\Users\Domain\User;
use AnimalSociety\Administration\Users\Domain\UserRepository;
use AnimalSociety\Shared\Domain\Criteria\Criteria;

final readonly class UserFinder
{
    public function __construct(
        private UserRepository $repository
    ) {}

    /**
     * @return User[]
     */
    public function __invoke(Criteria $criteria): array
    {
        return $this->repository->matching($criteria);
    }
}
