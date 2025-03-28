<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppTopCategoryRequest;
use Illuminate\Http\JsonResponse;

class AppTopCategoryController extends ApiController
{
    public function index(AppTopCategoryRequest $request): JsonResponse
    {
        return $this->success();
    }
}
