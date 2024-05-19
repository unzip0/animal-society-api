<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Provider\Laravel;

use AnimalSociety\Administration\Associations\Domain\SendWelcomeEmailOnAssociationCreated;
use AnimalSociety\Shared\Domain\Bus\Event\DomainEventSubscriber;
use AnimalSociety\Shared\Domain\Bus\Event\EventBus;
use AnimalSociety\Shared\Infrastructure\Bus\Event\InMemory\InMemoryLaravelEventBus;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

class InternalEventBusServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(EventBus::class, function (Container $app) {
            return new InMemoryLaravelEventBus($app);
        });
    }

    public function boot(): void
    {
        /** @var InMemoryLaravelEventBus $eventBus */
        $eventBus = $this->app->make(EventBus::class);

        array_map(function (string $subscriberClassName) use ($eventBus): void {
            /** @var DomainEventSubscriber $subscriber */
            $subscriber = $this->app->make($subscriberClassName);
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
        return [
            SendWelcomeEmailOnAssociationCreated::class,
        ];
    }
}
