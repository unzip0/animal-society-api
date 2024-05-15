<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Bus\Command;

use AnimalSociety\Shared\Domain\Bus\Command\Command;
use AnimalSociety\Shared\Domain\Bus\Command\CommandBus;
use Illuminate\Bus\Dispatcher;

class IlluminateCommandBus implements CommandBus
{
    public function __construct(
        protected Dispatcher $bus,
    ) {}

    public function dispatch(Command $command): void
    {
        $this->bus->dispatch($command);
    }

    /**
     * @param array<string,string> $map
     */
    public function register(array $map): void
    {
        $this->bus->map($map);
    }
}
