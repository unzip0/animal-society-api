<?php

declare(strict_types=1);

namespace AnimalSociety\Shared\Infrastructure\Http\Illuminate;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

final class IlluminateApiResponse
{
    /**
     * @param mixed[] $data
     */
    public static function create(
        array $data,
        ?int $httpCode = null,
    ): JsonResponse {
        /**
         * @phpstan-ignore-next-line
         */
        return response()->json(
            [
                'status_code' => $httpCode ?? Response::HTTP_OK,
                'data' => $data,
            ],
            $httpCode ?? Response::HTTP_OK,
        );
    }
}
