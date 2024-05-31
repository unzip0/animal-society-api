<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Shared\Infrastructure\PhpUnit\Comparator;

use AnimalSociety\Shared\Domain\Aggregate\AggregateRoot;
use AnimalSociety\Tests\Shared\Domain\TestUtils;
use SebastianBergmann\Comparator\Comparator;
use SebastianBergmann\Comparator\ComparisonFailure;

use SebastianBergmann\Exporter\Exporter;
use function Lambdish\Phunctional\all;
use function Lambdish\Phunctional\any;
use function Lambdish\Phunctional\instance_of;

final class AggregateRootArraySimilarComparator extends Comparator
{
    public function accepts($expected, $actual): bool
    {
        return is_array($expected)
               && is_array($actual)
               && (all(instance_of(AggregateRoot::class), $expected)
                   && all(instance_of(AggregateRoot::class), $actual));
    }

    public function assertEquals($expected, $actual, $delta = 0.0, $canonicalize = false, $ignoreCase = false): void
    {
        $exporter = new Exporter();

        if (!$this->contains($expected, $actual) || count($expected) !== count($actual)) {
            throw new ComparisonFailure(
                $expected,
                $actual,
                $exporter->export($expected),
                $exporter->export($actual),
                'Failed asserting the collection of AGs contains all the expected elements.'
            );
        }
    }

    private function contains(array $expectedArray, array $actualArray): bool
    {
        $exists = fn (AggregateRoot $expected): bool => any(
            fn (AggregateRoot $actual): bool => TestUtils::isSimilar($expected, $actual),
            $actualArray
        );

        return all($exists, $expectedArray);
    }
}
