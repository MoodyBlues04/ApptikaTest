<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppTopCategoryRequest;
use App\Repositories\TopAppHistoryRepository;
use App\Services\ApiResponseService;
use Illuminate\Http\JsonResponse;

class AppTopCategoryController extends ApiController
{
    public function __construct(
        ApiResponseService $apiResponseService,
        private readonly TopAppHistoryRepository $repository
    ) {
        parent::__construct($apiResponseService);
    }

    public function index(AppTopCategoryRequest $request): JsonResponse
    {
        $data = $this->repository->getBestCategoryPositionsByDate($request->date);
        return $this->success('success', $data);
    }
}
