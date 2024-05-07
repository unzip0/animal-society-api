<?php

declare(strict_types=1);

namespace App\Http\Controllers\Administration\Users;

use AnimalSociety\Shared\Infrastructure\Http\ApiController;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;

final class UsersLogoutController extends ApiController
{
    public function __invoke(): Response
    {
        /**
         * @phpstan-ignore-next-line
         */
        $token = JWTAuth::getToken();
        /**
         * @phpstan-ignore-next-line
         */
        JWTAuth::invalidate($token);

        return $this->response([]);
    }

    /**
     * @return array<string, int>
     */
    protected function exceptions(): array
    {
        return [];
    }
}
