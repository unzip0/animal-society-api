<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Users;

use AnimalSociety\Administration\Users\Domain\User;
use AnimalSociety\Administration\Users\Domain\UserRepository;
use AnimalSociety\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;

abstract class UsersModuleUnitTestCase extends UnitTestCase
{
    private UserRepository|MockInterface|null $repository = null;

    protected function shouldSave(User $user): void
    {
        $this->repository()
            ->shouldReceive('save')
            ->with($this->similarTo($user))
            ->once()
            ->andReturnNull();
    }

    protected function shouldCreate(User $user): void
    {
        $this->repository()
            ->shouldReceive('create')
            ->with($this->similarTo($user))
            ->once()
            ->andReturnNull();
    }

    protected function shouldFindOneByCriteria(array $criteria, ?User $user): void
    {
        $this->repository()
            ->shouldReceive('findOneBy')
            ->with($criteria)
            ->once()
            ->andReturn($user);
    }

    protected function shouldNotFindOneByCriteria(array $criteria): void
    {
        $this->repository()
            ->shouldReceive('findOneBy')
            ->with($criteria)
            ->once()
            ->andReturn(null);
    }

    protected function shouldReturnEmptyArray(): void
    {
        $this->repository()
            ->shouldReceive('findAll')
            ->once()
            ->andReturn([]);
    }

    protected function shouldReturnItemsInArray(User $user): void
    {
        $this->repository()
            ->shouldReceive('findAll')
            ->once()
            ->andReturn(
                [$this->similarTo($user->toArray())]
            );
    }

    protected function repository(): UserRepository|MockInterface
    {
        return $this->repository ??= $this->mock(UserRepository::class);
    }
}
