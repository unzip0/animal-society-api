<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Animals;

use AnimalSociety\Administration\Animals\Domain\Animal;
use AnimalSociety\Administration\Animals\Domain\AnimalRepository;
use AnimalSociety\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;

abstract class AnimalsModuleUnitTestCase extends UnitTestCase
{
    private AnimalRepository|MockInterface|null $repository = null;

    protected function shouldSave(Animal $animal): void
    {
        $this->repository()
            ->shouldReceive('save')
            ->with($this->similarTo($animal))
            ->once()
            ->andReturnNull();
    }

    protected function shouldCreate(Animal $animal): void
    {
        $this->repository()
            ->shouldReceive('create')
            ->with($this->similarTo($animal))
            ->once()
            ->andReturnNull();
    }

    protected function shouldFindOneByCriteria(array $criteria, ?Animal $animal): void
    {
        $this->repository()
            ->shouldReceive('findOneBy')
            ->with($criteria)
            ->once()
            ->andReturn($animal);
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

    protected function shouldReturnItemsInArray(Animal $animal): void
    {
        $this->repository()
            ->shouldReceive('matchingByCriteria')
            ->withAnyArgs()
            ->once()
            ->andReturn(
                [$this->similarTo($animal->toArray())]
            );
    }

    protected function repository(): AnimalRepository|MockInterface
    {
        return $this->repository ??= $this->mock(AnimalRepository::class);
    }
}
