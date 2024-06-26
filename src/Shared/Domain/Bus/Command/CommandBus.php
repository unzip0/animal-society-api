<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Domain\Bus\Command;

interface CommandBus
{
    public function dispatch(Command $command): void;

    /**
     * @param array<string,string> $map
     */
    public function register(array $map): void;
}
