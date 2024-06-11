<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Database\Eloquent;

use AnimalSociety\Shared\Domain\Mapper\Domain;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Mappers\ModelDomainMapper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class EloquentRepository
{
    public function store(Domain $domain): ?Model
    {
        /** @var Model $model */
        $model = $this->builder()->create($domain->transform());

        return $model->fresh();
    }

    public function find(mixed $id): ?Domain
    {
        $model = $this->builder()->find($id);

        if ($model === null) {
            return null;
        }
        /** @var Model $model */
        return $this->modelDomainMapper()->modelToDomain($model);
    }

    /**
     * @param array<string, mixed> $criteria
     */
    public function findOneByCriteria(array $criteria): ?Domain
    {
        $builder = $this->builder();
        foreach ($criteria as $key => $value) {
            $builder->where($key, $value);
        }
        $model = $builder->first();

        if ($model === null) {
            return null;
        }

        /** @var Model $model */
        return $this->modelDomainMapper()->modelToDomain($model);
    }

    /**
     * @param array<string, mixed> $criteria
     * @return Domain[]
     */
    public function findByCriteria(array $criteria): array
    {
        $builder = $this->builder();
        foreach ($criteria as $key => $value) {
            $builder->where($key, $value);
        }
        /** @var Collection<Model> $collection */
        $collection = $builder->get();

        return $this->modelDomainMapper()
            ->collectionModelToCollectionDomain($collection)
            ->toArray();
    }

    public function persist(Domain $domain): void
    {
        $model = $this->modelDomainMapper()->domainToModel($domain);
        $model->save();
    }

    public function update(Domain $domain): void
    {
        $attributes = $this->modelDomainMapper()->domainToModel($domain)->toArray();

        $id = $attributes[$this->model()->getKeyName()];

        $model = $this->builder()->find($id);

        if ($model === null) {
            return;
        }

        /** @var Model $model */
        $model->update($attributes);
    }

    abstract protected function model(): Model;

    abstract protected function modelDomainMapper(): ModelDomainMapper;

    protected function builder(): Builder
    {
        return $this->model()->newQuery();
    }

    protected function hardDelete(Domain $domain): ?bool
    {
        $model = $this->modelDomainMapper()->domainToModel($domain);
        return $this->builder()->find($model->getKey())->delete(); // @phpstan-ignore-line
    }
}
