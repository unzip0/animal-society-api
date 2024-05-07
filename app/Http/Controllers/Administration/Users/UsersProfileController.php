<?php

declare(strict_types=1);

namespace App\Http\Controllers\Administration\Users;

use AnimalSociety\Administration\Users\Domain\User;
use AnimalSociety\Shared\Infrastructure\Http\ApiController;
use Symfony\Component\HttpFoundation\Response;

final class UsersProfileController extends ApiController
{
    public function __invoke(): Response
    {
        /**
         * @var User $user
         * @phpstan-ignore-next-line
         */
        $user = auth()->user();

        return $this->response($user->profile());
    }

    /**
     * @return array<string, int>
     */
    protected function exceptions(): array
    {
        return [];
    }
}
