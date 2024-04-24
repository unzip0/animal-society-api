<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Http;

use AnimalSociety\Shared\Domain\Bus\Command\Command;
use AnimalSociety\Shared\Domain\Bus\Command\CommandBus;
use AnimalSociety\Shared\Domain\Bus\Query\Query;
use AnimalSociety\Shared\Domain\Bus\Query\QueryBus;
use AnimalSociety\Shared\Domain\Bus\Query\Response;

use function Lambdish\Phunctional\each;

abstract class ApiController
{
    public function __construct(
        private readonly QueryBus $queryBus,
        private readonly CommandBus $commandBus,
        ApiExceptionsCodeMapping $exceptionHandler
    ) {
        each(
            fn (int $httpCode, string $exceptionClass) => $exceptionHandler->register($exceptionClass, $httpCode),
            $this->exceptions()
        );
    }

    /**
     * @return array<string, int>
     */
    abstract protected function exceptions(): array;

    protected function ask(Query $query): ?Response
    {
        return $this->queryBus->ask($query);
    }

    protected function dispatch(Command $command): void
    {
        $this->commandBus->dispatch($command);
    }
}
