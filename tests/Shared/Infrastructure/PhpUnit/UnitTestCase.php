<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Shared\Infrastructure\PhpUnit;

use AnimalSociety\Shared\Domain\Bus\Command\Command;
use AnimalSociety\Shared\Domain\Bus\Event\DomainEvent;
use AnimalSociety\Shared\Domain\Bus\Event\EventBus;
use AnimalSociety\Shared\Domain\Bus\Query\Query;
use AnimalSociety\Shared\Domain\Bus\Query\Response;
use AnimalSociety\Tests\Shared\Domain\TestUtils;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\Matcher\MatcherInterface;
use Mockery\MockInterface;
use Throwable;

abstract class UnitTestCase extends MockeryTestCase
{
    private EventBus|MockInterface|null $eventBus = null;

    protected function mock(string $className): MockInterface
    {
        return Mockery::mock($className);
    }

    protected function shouldPublishDomainEvent(DomainEvent $domainEvent): void
    {
        $this->eventBus()
            ->shouldReceive('publish')
            ->with($this->similarTo($domainEvent))
            ->andReturnNull();
    }

    protected function shouldNotPublishDomainEvent(): void
    {
        $this->eventBus()
            ->shouldReceive('publish')
            ->withNoArgs()
            ->andReturnNull();
    }

    protected function eventBus(): EventBus|MockInterface
    {
        return $this->eventBus ??= $this->mock(EventBus::class);
    }

    protected function notify(DomainEvent $event, callable $subscriber): void
    {
        $subscriber($event);
    }

    protected function dispatch(Command $command, callable $commandHandler): void
    {
        $commandHandler($command);
    }

    protected function assertAskResponse(Response $expected, Query $query, callable $queryHandler): void
    {
        $actual = $queryHandler($query);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @param class-string<Throwable> $expectedErrorClass
     */
    protected function assertAskThrowsException(string $expectedErrorClass, Query $query, callable $queryHandler): void
    {
        $this->expectException($expectedErrorClass);

        $queryHandler($query);
    }

    protected function isSimilar(mixed $expected, mixed $actual): bool
    {
        return TestUtils::isSimilar($expected, $actual);
    }

    protected function assertSimilar(mixed $expected, mixed $actual): void
    {
        TestUtils::assertSimilar($expected, $actual);
    }

    protected function similarTo(mixed $value, float $delta = 0.0): MatcherInterface
    {
        return TestUtils::similarTo($value, $delta);
    }
}
