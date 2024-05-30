<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Associations;

use AnimalSociety\Administration\Associations\Domain\Association;
use AnimalSociety\Administration\Associations\Domain\AssociationRepository;
use AnimalSociety\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;

abstract class AssociationsModuleUnitTestCase extends UnitTestCase
{
    private AssociationRepository|MockInterface|null $repository = null;

    protected function shouldSave(Association $association): void
    {
        $this->repository()
            ->shouldReceive('save')
            ->with($this->similarTo($association))
            ->once()
            ->andReturnNull();
    }

    protected function shouldCreate(Association $association): void
    {
        $this->repository()
            ->shouldReceive('create')
            ->with($this->similarTo($association))
            ->once()
            ->andReturnNull();
    }

    protected function shouldFindOneByCriteria(array $criteria, ?Association $association): void
    {
        $this->repository()
            ->shouldReceive('findOneBy')
            ->with($criteria)
            ->once()
            ->andReturn($association);
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

    protected function shouldReturnItemsInArray(Association $association): void
    {
        $this->repository()
            ->shouldReceive('findAll')
            ->once()
            ->andReturn(
                [$this->similarTo($association->toArray())]
            );
    }

    protected function repository(): AssociationRepository|MockInterface
    {
        return $this->repository ??= $this->mock(AssociationRepository::class);
    }
}
