<?php

namespace App\Services;

use App\Modules\Api\Apptika\ApptikaApi;
use App\Modules\Api\Apptika\Request\TopHistoryRequest;
use App\Repositories\TopAppHistoryRepository;
use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;

class ApptikaService
{
    public function __construct(
        private readonly ApptikaApi $api,
        private readonly TopAppHistoryRepository $repository
    ) {
    }

    /**
     * @throws \Exception|GuzzleException
     */
    public function loadTopAppHistory(Carbon $dateFrom, Carbon $dateTo): int
    {
        $response = $this->api->topHistory(TopHistoryRequest::defaultRequest($dateFrom->toDateString(), $dateTo->toDateString()));
        if (!$response->isOk()) {
            throw new \Exception("Cannot load top info history. Error: {$response->getError()}. Message: {$response->getMessage()}");
        }

        $loadedCount = 0;
        foreach ($response->getData() as $categoryId => $categoryData) { // insert for better performance
            $loadedCount += $this->repository->insertOrIgnore($this->prepareData((int)$categoryId, $categoryData));
        }
        return $loadedCount;
    }

    private function prepareData(int $categoryId, array &$categoryData): array
    {
        $res = [];
        foreach ($categoryData as $subCategoryId => $subCategoryData) {
            foreach ($subCategoryData as $date => $position) {
                if (is_null($position)) {
                    continue;
                }
                $res []= [
                    'category_id' => $categoryId,
                    'app_id' => TopHistoryRequest::AMONG_US_APP,
                    'date' => $date,
                    'position' => $position,
                ];
            }
        }
        return $res;
    }
}
