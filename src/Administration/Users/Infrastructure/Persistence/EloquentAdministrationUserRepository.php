<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Infrastructure\Persistence;

use AnimalSociety\Administration\Users\Domain\User;
use AnimalSociety\Administration\Users\Domain\UserId;
use AnimalSociety\Administration\Users\Domain\UserRepository;
use AnimalSociety\Shared\Domain\Mapper\Domain;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\EloquentRepository;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Mappers\ModelDomainMapper;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Mappers\UserMapper;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Models\User as ModelsUser;
use Illuminate\Database\Eloquent\Model;

final class EloquentAdministrationUserRepository extends EloquentRepository implements UserRepository
{
    public function create(User $user): void
    {
        $this->store($user);
    }

    public function save(User $user): void
    {
        $this->persist($user);
    }

    public function updateUser(User $user): void
    {
        $this->update($user);
    }

    public function findById(UserId $id): ?Domain
    {
        return $this->find($id->value());
    }

    /**
     * @param array<string,mixed> $criteria
     */
    public function findOneBy(array $criteria): ?Domain
    {
        return $this->findOneByCriteria($criteria);
    }

    /**
     * @return Domain[]
     */
    public function findAll(): array
    {
        return $this->findByCriteria([]);
    }

    /**
     * @param array<string,mixed> $criteria
     * @return Domain[]
     */
    public function matchingByCriteria(array $criteria): array
    {
        return $this->findByCriteria($criteria);
    }

    protected function model(): Model
    {
        return new ModelsUser();
    }

    protected function modelDomainMapper(): ModelDomainMapper
    {
        return new UserMapper();
    }
}
