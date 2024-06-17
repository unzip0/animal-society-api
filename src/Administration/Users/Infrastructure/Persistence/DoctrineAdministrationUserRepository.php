<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Infrastructure\Persistence;

use AnimalSociety\Administration\Users\Domain\User;
use AnimalSociety\Administration\Users\Domain\UserId;
use AnimalSociety\Administration\Users\Domain\UserRepository;
use AnimalSociety\Shared\Domain\Mapper\Domain;
use AnimalSociety\Shared\Infrastructure\Database\Doctrine\DoctrineRepository;

final class DoctrineAdministrationUserRepository extends DoctrineRepository implements UserRepository
{
    public function save(User $user): void
    {
        $this->persist($user);
    }

    public function create(User $user): void
    {
        /** @var User $user */
        $this->persist($user);
    }

    public function findById(UserId $id): ?Domain
    {
        return $this->repository(User::class)->find($id);
    }

    /**
     * @param array<string,mixed> $criteria
     */
    public function findOneBy(array $criteria): ?User
    {
        return $this->repository(User::class)->findOneBy($criteria);
    }

    /**
     * @return User[]
     */
    public function findAll(): array
    {
        return $this->repository(User::class)->findAll();
    }

    public function updateUser(User $user): void
    {
        $this->persist($user);
    }

    public function matchingByCriteria(array $criteria): array
    {
        return [];
    }

    // /**
    //  * @return User[]
    //  */
    // public function matching(Criteria $criteria): array
    // {
    //     $doctrineCriteria = DoctrineCriteriaConverter::convert($criteria);

    //     return $this->repository(User::class)->matching($doctrineCriteria)->toArray();
    // }
}
