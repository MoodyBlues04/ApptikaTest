<?php

namespace App\Modules\Api;

use GuzzleHttp\Exception\GuzzleException;

abstract class BaseApi
{
    public function __construct(
        protected readonly string $baseUrl,
        protected readonly Client $client
    ) {
    }

    /**
     * @throws GuzzleException
     */
    public function get(string $url, ApiRequest $request): array
    {
        return $this->client->get($this->url($url), $request->getRequest());
    }

    /**
     * @throws GuzzleException
     */
    public function post(string $url, ApiRequest $request, array $headers = []): array
    {
        return $this->client->post($this->url($url), $request->getRequest(), $headers);
    }

    private function url(string $url): string
    {
        return $this->baseUrl . $url;
    }
}
