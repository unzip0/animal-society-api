<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Domain\Criteria;

use AnimalSociety\Shared\Domain\Collection;

use function Lambdish\Phunctional\reduce;

final class Filters extends Collection
{
    /** @param array<array<string,mixed>> $values */
    public static function fromValues(array $values): self
    {
        return new self(array_map(self::filterBuilder(), $values));
    }

    public function add(Filter $filter): self
    {
        return new self(array_merge($this->items(), [$filter]));
    }

    /** @return Filter[] */
    public function filters(): array
    {
        return $this->items();
    }

    public function serialize(): string
    {
        return reduce(
            static fn (string $accumulate, Filter $filter): string => sprintf(
                '%s^%s',
                $accumulate,
                $filter->serialize()
            ),
            $this->items(),
            ''
        );
    }

    protected function type(): string
    {
        return Filter::class;
    }

    private static function filterBuilder(): callable
    {
        return fn (array $values): Filter => Filter::fromValues($values);
    }
}
