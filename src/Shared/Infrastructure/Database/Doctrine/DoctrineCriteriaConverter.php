<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Database\Doctrine;

use AnimalSociety\Shared\Domain\Criteria\Criteria;
use AnimalSociety\Shared\Domain\Criteria\Filter;
use AnimalSociety\Shared\Domain\Criteria\FilterField;
use AnimalSociety\Shared\Domain\Criteria\OrderBy;
use Doctrine\Common\Collections\Criteria as DoctrineCriteria;
use Doctrine\Common\Collections\Expr\Comparison;
use Doctrine\Common\Collections\Expr\CompositeExpression;

final readonly class DoctrineCriteriaConverter
{
    /**
     * @param array<string,string> $criteriaToDoctrineFields
     * @param mixed[] $hydrators
     * */
    public function __construct(
        private Criteria $criteria,
        private array $criteriaToDoctrineFields = [],
        private array $hydrators = []
    ) {}

    /**
     * @param array<string,string> $criteriaToDoctrineFields
     * @param mixed[] $hydrators
     * */
    public static function convert(
        Criteria $criteria,
        array $criteriaToDoctrineFields = [],
        array $hydrators = []
    ): DoctrineCriteria {
        $converter = new self($criteria, $criteriaToDoctrineFields, $hydrators);

        return $converter->convertToDoctrineCriteria();
    }

    private function convertToDoctrineCriteria(): DoctrineCriteria
    {
        return new DoctrineCriteria(
            $this->buildExpression($this->criteria),
            $this->formatOrder($this->criteria),
            $this->criteria->offset(),
            $this->criteria->limit()
        );
    }

    private function buildExpression(Criteria $criteria): ?CompositeExpression
    {
        if ($criteria->hasFilters()) {
            return new CompositeExpression(
                CompositeExpression::TYPE_AND,
                array_map($this->buildComparison(), $criteria->plainFilters())
            );
        }

        return null;
    }

    private function buildComparison(): callable
    {
        return function (Filter $filter): Comparison {
            $field = $this->mapFieldValue($filter->field());
            $value = $this->existsHydratorFor($field)
                ? $this->hydrate($field, $filter->value()->value())
                : $filter->value()->value();

            return new Comparison($field, $filter->operator()->value, $value);
        };
    }

    private function mapFieldValue(FilterField $field): mixed
    {
        return array_key_exists($field->value(), $this->criteriaToDoctrineFields)
            ? $this->criteriaToDoctrineFields[$field->value()]
            : $field->value();
    }

    /** @return mixed[]*/
    private function formatOrder(Criteria $criteria): ?array
    {
        if (!$criteria->hasOrder()) {
            return null;
        }

        return [
            $this->mapOrderBy($criteria->order()->orderBy()) => $criteria->order()->orderType(),
        ];
    }

    private function mapOrderBy(OrderBy $field): mixed
    {
        return array_key_exists($field->value(), $this->criteriaToDoctrineFields)
            ? $this->criteriaToDoctrineFields[$field->value()]
            : $field->value();
    }

    private function existsHydratorFor(mixed $field): bool
    {
        return array_key_exists($field, $this->hydrators);
    }

    private function hydrate(mixed $field, string $value): mixed
    {
        return $this->hydrators[$field]($value);
    }
}
