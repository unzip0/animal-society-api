<?php

declare(strict_types=1);

namespace AnimalSociety\Administration\Users\Application\findAll;

use AnimalSociety\Administration\Users\Application\UsersResponse;
use AnimalSociety\Shared\Domain\Bus\Query\QueryHandler;

final readonly class FindAllUsersQueryHandler implements QueryHandler
{
    public function __construct(
        private UserSearcher $searcher
    ) {}

    public function __invoke(FindAllUsersQuery $query): UsersResponse
    {
        return $this->searcher->findAll($query->associationId());
    }
}
