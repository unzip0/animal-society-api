<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Domain;

use AnimalSociety\Shared\Domain\Mapper\Domain;

interface UserRepository
{
    public function save(User $user): void;

    public function create(User $user): void;

    /**
     * @return Domain[]
     */
    public function findAll(): array;

    /**
     * @param array<string,mixed> $criteria
     * @return Domain[]
     */
    public function matchingByCriteria(array $criteria): array;

    /**
     * @param array<string,mixed> $criteria
     */
    public function findOneBy(array $criteria): ?Domain;

    public function findById(UserId $id): ?Domain;

    public function updateUser(User $user): void;
}
