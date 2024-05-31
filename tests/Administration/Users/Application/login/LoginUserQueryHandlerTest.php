<?php

declare(strict_types=1);

namespace AnimalSociety\Tests\Administration\Users\Application\login;

use AnimalSociety\Administration\Users\Application\login\LoginUserQueryHandler;
use AnimalSociety\Administration\Users\Application\login\UserLogin;
use AnimalSociety\Administration\Users\Domain\UserEmail;
use AnimalSociety\Administration\Users\Domain\UserPassword;
use AnimalSociety\Tests\Administration\Users\Domain\UserLoginResponseMother;
use AnimalSociety\Tests\Administration\Users\Domain\UserMother;
use AnimalSociety\Tests\Administration\Users\UsersModuleUnitTestCase;

final class LoginUserQueryHandlerTest extends UsersModuleUnitTestCase
{
    private LoginUserQueryHandler|null $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new LoginUserQueryHandler(
            new UserLogin(
                $this->repository(),
            )
        );
    }

    public function testItShouldLoginUser(): void
    {
        $this->markTestSkipped('refactor login use case');
        $query = LoginUserQueryMother::create();
        $user = UserMother::create(
            email: new UserEmail($query->email()),
            password: new UserPassword($query->password()),
        );
        $response = UserLoginResponseMother::create(
            $user,
            random_bytes(32),
        );

        $this->shouldFindOneByCriteria(
            [
                'email' => $query->email(),
            ],
            $user
        );

        $this->assertAskResponse($response, $query, $this->handler);
    }
}
