<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Animals;

use AnimalSociety\Administration\Animals\Domain\Animal;
use AnimalSociety\Administration\Animals\Domain\AnimalId;
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

    protected function shouldFindById(AnimalId $id, Animal $animal): void
    {
        $this->repository()
            ->shouldReceive('findById')
            ->with($id->value())
            ->once()
            ->andReturn($animal);
    }

    protected function shouldNotFindByid(AnimalId $id): void
    {
        $this->repository()
            ->shouldReceive('findById')
            ->with($id->value())
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

    protected function shouldMatchByCriteria(Animal $animal): void
    {
        $this->repository()
            ->shouldReceive('matchingByCriteria')
            ->withAnyArgs()
            ->once()
            ->andReturn(
                [$animal]
            );
    }

    protected function shouldDelete(Animal $animal): void
    {
        $this->repository()
            ->shouldReceive('delete')
            ->with($this->similarTo($animal))
            ->once()
            ->andReturnNull();
    }

    protected function shouldUpdate(Animal $animal): void
    {
        $this->repository()
            ->shouldReceive('updateAnimal')
            ->with($this->similarTo($animal))
            ->once()
            ->andReturnNull();
    }

    protected function repository(): AnimalRepository|MockInterface
    {
        return $this->repository ??= $this->mock(AnimalRepository::class);
    }
}
