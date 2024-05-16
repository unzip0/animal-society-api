<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Bus\Event\InMemory;

use AnimalSociety\Shared\Domain\Bus\Event\DomainEvent;
use AnimalSociety\Shared\Domain\Bus\Event\EventBus;
use Illuminate\Support\Collection;

class InMemoryLaravelEventBus implements EventBus
{
    protected Collection $subscribers;

    public function __construct()
    {
        $this->subscribers = new Collection();
    }

    public function subscribe(
        string $eventClassName,
        string $handlerClassName
    ): void {
        if (!$this->subscribers->has($eventClassName)) {
            $this->subscribers[$eventClassName] = new Collection();
        }

        $this->subscribers[$eventClassName]->push($handlerClassName);
    }

    public function publish(DomainEvent ...$events): void
    {
        foreach ($events as $event) {
            foreach ($this->subscribers[$event::class] ?? [] as $subscriber) {
                (new $subscriber())->__invoke($event); //@phpstan-ignore-line
            }
        }
    }
}
