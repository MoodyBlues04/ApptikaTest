<?php

namespace App\Exceptions;

use App\Services\ApiResponseService;
use Illuminate\Container\Container;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    public function __construct(
        Container $container,
        private readonly ApiResponseService $apiResponseService
    ) {
        parent::__construct($container);
    }

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

    public function render($request, Throwable $e): Response
    {
        if ($request->wantsJson()) {
            if ($e instanceof ValidationException) {
                return $this->apiResponseService->error(
                    'Validation failed',
                    Response::HTTP_UNPROCESSABLE_ENTITY,
                    $e->errors()
                );
            }

            // todo custom exception for better error-handling

            return $this->apiResponseService->error(
                $e->getMessage(),
                method_exists($e, 'getStatusCode') ? $e->getStatusCode() : Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        return parent::render($request, $e);
    }

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
