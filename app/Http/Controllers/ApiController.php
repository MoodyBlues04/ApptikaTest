<?php

namespace App\Http\Controllers;

use App\Services\ApiResponseService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    public function __construct(protected readonly ApiResponseService $apiResponseService)
    {
    }

    protected function success(string $message = 'success', array $data = [], int $statusCode = Response::HTTP_OK): JsonResponse
    {
        return $this->apiResponseService->success($message, $data, $statusCode);
    }

    protected function error(string $message = 'error', int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR, array $errors = []): JsonResponse
    {
        return $this->apiResponseService->error($message, $statusCode, $errors);
    }
}
