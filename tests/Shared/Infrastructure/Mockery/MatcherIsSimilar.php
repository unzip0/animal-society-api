<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Shared\Infrastructure\Mockery;

use AnimalSociety\Tests\Shared\Infrastructure\PhpUnit\Constraint\ConstraintIsSimilar;
use Mockery\Matcher\MatcherInterface;
use Stringable;

final class MatcherIsSimilar implements Stringable, MatcherInterface
{
    private readonly ConstraintIsSimilar $constraint;

    public function __construct(mixed $value, float $delta = 0.0)
    {
        $this->constraint = new ConstraintIsSimilar($value, $delta);
    }

    public function __toString(): string
    {
        return 'Is similar';
    }

    public function match(&$actual): bool
    {
        return $this->constraint->evaluate($actual, '', true);
    }
}
