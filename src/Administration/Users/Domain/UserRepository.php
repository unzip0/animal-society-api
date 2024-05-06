<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Domain;

use AnimalSociety\Shared\Domain\Criteria\Criteria;

interface UserRepository
{
    public function save(User $user): void;

    /**
     * @return User[]
     */
    public function findAll(): array;

    public function find(UserId $id): ?User;

    /**
     * @return User[]
     */
    public function matching(Criteria $criteria): array;
}