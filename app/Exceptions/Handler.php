<?php

declare(strict_types=1);

namespace App\Exceptions;

use AnimalSociety\Shared\Domain\Http\Exception\ApiResponseException;
use AnimalSociety\Shared\Domain\Http\Exception\InteralServerErrorException;
use AnimalSociety\Shared\Domain\Http\Exception\ServerErrorException;
use Closure;
use Error;
use ErrorException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use LogicException;
use RuntimeException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(
            $this->httpResponseExceptionRenderable()
        );

        $this->renderable(
            $this->serverErrorRenderable()
        );
    }

    protected function shouldReturnJson($request, Throwable $e)
    {
        return true;
    }

    protected function prepareJsonResponse($request, Throwable $e)
    {
        $debug = (bool) config('app.debug');
        $messageDebug = $debug ? $e->getMessage() : InteralServerErrorException::MESSAGE;

        /**
         * @phpstan-ignore-next-line
         */
        return ApiResponseException::create(
            $e instanceof ApiResponseException ? $e->getMessage() : $messageDebug,
            $e instanceof ApiResponseException ? $e->getCode() : InteralServerErrorException::CODE,
            $e instanceof ApiResponseException ? null : InteralServerErrorException::HTTP_STATUS,
        )->getResponse();
    }

    private function httpResponseExceptionRenderable(): Closure
    {
        return function (Throwable $exception, $request): ?Response {
            $response = null;

            if ($exception instanceof HttpResponseException) {
                $response = $exception->getResponse();
            }

            if (!$response instanceof Response) {
                return null;
            }

            return $response;
        };
    }

    private function serverErrorRenderable(): Closure
    {
        return function (Throwable $exception, $request): ?Response {
            if ($exception instanceof HttpResponseException) {
                return null;
            }

            if (
                !$exception instanceof RuntimeException
                && !$exception instanceof LogicException
                && !$exception instanceof ErrorException
                && !$exception instanceof Error
            ) {
                return null;
            }

            $debug = (bool) config('app.debug');

            $serverErrorException = ServerErrorException::create(
                $debug ? $exception->getMessage() : null
            );

            return $serverErrorException->getResponse();
        };
    }
}
