<?php

declare(strict_types=1);

namespace App\Http\Controllers\HealthCheck;

use Illuminate\Http\JsonResponse;

final readonly class HealthCheckGetController
{
    public function __construct() {}

    public function __invoke(): JsonResponse
    {
        return new JsonResponse(
            [
                'health-check' => 'ok',
                'rand' => random_int(1, 5),
            ]
        );
    }
}
