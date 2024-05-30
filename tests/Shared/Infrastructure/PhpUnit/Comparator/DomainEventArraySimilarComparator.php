<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Shared\Infrastructure\PhpUnit\Comparator;

use AnimalSociety\Shared\Domain\Bus\Event\DomainEvent;
use AnimalSociety\Shared\Infrastructure\Test\Shared\Domain\TestUtils;
use SebastianBergmann\Comparator\Comparator;
use SebastianBergmann\Comparator\ComparisonFailure;

use function Lambdish\Phunctional\all;
use function Lambdish\Phunctional\any;
use function Lambdish\Phunctional\instance_of;

final class DomainEventArraySimilarComparator extends Comparator
{
    public function accepts($expected, $actual): bool
    {
        return is_array($expected)
               && is_array($actual)
               && (all(instance_of(DomainEvent::class), $expected)
                   && all(instance_of(DomainEvent::class), $actual));
    }

    public function assertEquals($expected, $actual, $delta = 0.0, $canonicalize = false, $ignoreCase = false): void
    {
        if (!$this->contains($expected, $actual) || count($expected) !== count($actual)) {
            throw new ComparisonFailure(
                $expected,
                $actual,
                // $this->exporter->export($expected),
                // $this->exporter->export($actual),
                (string) $expected,
                (string) $actual,
                'Failed asserting the collection of Events contains all the expected elements.'
            );
        }
    }

    private function contains(array $expectedArray, array $actualArray): bool
    {
        $exists = static fn (DomainEvent $expected): bool => any(
            static fn (DomainEvent $actual): bool => TestUtils::isSimilar($expected, $actual),
            $actualArray
        );

        return all($exists, $expectedArray);
    }
}
