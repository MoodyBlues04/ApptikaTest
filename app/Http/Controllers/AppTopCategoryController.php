<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppTopCategoryRequest;
use App\Modules\Api\Apptika\ApptikaApi;
use App\Modules\Api\Apptika\Request\TopHistoryRequest;
use App\Modules\Api\Client;
use Illuminate\Http\JsonResponse;

class AppTopCategoryController extends ApiController
{
    public function index(AppTopCategoryRequest $request): JsonResponse
    {
        return $this->success('message', [
            'api_resp' => (new ApptikaApi(new Client()))->topHistory(TopHistoryRequest::defaultRequest('2025-03-05', '2025-03-28'))
        ]);
    }
}
