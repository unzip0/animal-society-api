<?php

declare(strict_types=1);

namespace App\Http\Controllers\Administration\Users;

use AnimalSociety\Administration\Users\Domain\User as DomainUser;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Mappers\UserMapper;
use AnimalSociety\Shared\Infrastructure\Database\Eloquent\Models\User as ModelUser;
use AnimalSociety\Shared\Infrastructure\Http\ApiController;
use Symfony\Component\HttpFoundation\Response;

final class UsersProfileController extends ApiController
{
    public function __invoke(UserMapper $userMapper): Response
    {
        /**
         * @var ModelUser $user
         * @phpstan-ignore-next-line
         */
        $user = auth()->user();

        /** @var DomainUser $domainUser */
        $domainUser = $userMapper->modelToDomain($user);

        return $this->response($domainUser->profile());
    }

    /**
     * @return array<string, int>
     */
    protected function exceptions(): array
    {
        return [];
    }
}
