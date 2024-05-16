<?php

declare(strict_types=1);

namespace App\Providers;

use AnimalSociety\Shared\Domain\Bus\Event\DomainEventSubscriber;
use AnimalSociety\Shared\Domain\Bus\Event\EventBus;
use AnimalSociety\Shared\Infrastructure\Bus\Event\InMemory\InMemoryLaravelEventBus;
use Illuminate\Support\ServiceProvider;

class InternalEventBusServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(EventBus::class, function () {
            return new InMemoryLaravelEventBus();
        });
    }

    public function boot(): void
    {
        /** @var InMemoryLaravelEventBus $eventBus */
        $eventBus = $this->app->make(EventBus::class);

        array_map(function (string $subscriberClassName) use ($eventBus): void {
            /** @var DomainEventSubscriber $subscriber */
            $subscriber = new $subscriberClassName();
            array_map(function (string $eventClassName) use ($eventBus, $subscriberClassName): void {
                $eventBus->subscribe($eventClassName, $subscriberClassName);
            }, $subscriber::subscribedTo());
        }, $this->subscribers());
    }

    /**
     * @return string[]
     */
    private function subscribers(): array
    {
        return [];
    }
}
