<?php

namespace App\Modules\Api\Apptika;

use App\Modules\Api\Apptika\Request\TopHistoryRequest;
use App\Modules\Api\Apptika\Response\ApptikaResponse;
use App\Modules\Api\BaseApi;
use App\Modules\Api\Client;
use GuzzleHttp\Exception\GuzzleException;

class ApptikaApi extends BaseApi
{
    private const BASE_URL = 'https://api.apptica.com';

    public function __construct(Client $client)
    {
        parent::__construct(self::BASE_URL, $client);
    }

    /**
     * @throws GuzzleException
     */
    public function topHistory(TopHistoryRequest $request): ApptikaResponse
    {
        $res = $this->get("/package/top_history/{$request->applicationId}/{$request->countryId}", $request);
        return new ApptikaResponse($res);
    }
}
