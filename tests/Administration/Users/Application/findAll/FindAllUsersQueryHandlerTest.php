<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Users\Application\findAll;

use AnimalSociety\Administration\Users\Application\findAll\FindAllUsersQueryHandler;
use AnimalSociety\Administration\Users\Application\findAll\UserSearcher;
use AnimalSociety\Tests\Administration\Users\Domain\UserMother;
use AnimalSociety\Tests\Administration\Users\Domain\UsersResponseMother;
use AnimalSociety\Tests\Administration\Users\UsersModuleUnitTestCase;
use AnimalSociety\Tests\Shared\Domain\UuidMother;

final class FindAllUsersQueryHandlerTest extends UsersModuleUnitTestCase
{
    private FindAllUsersQueryHandler|null $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new FindAllUsersQueryHandler(
            new UserSearcher(
                $this->repository(),
            )
        );
    }

    public function testItShouldReturnAllUsers(): void
    {
        $this->markTestSkipped('TODO');
        $associationId = UuidMother::create();
        $query = FindAllUsersQueryMother::create($associationId);
        $user = UserMother::create();
        $response = UsersResponseMother::create($user);

        $this->shouldReturnItemsInArray([
            'association_id' => $associationId,
        ], $user);

        $this->assertAskResponse($response, $query, $this->handler);
    }
}
