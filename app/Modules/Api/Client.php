<?php

namespace App\Modules\Api;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\GuzzleException;

class Client
{
    private GuzzleHttpClient $client;

    public function __construct()
    {
        $this->client = new GuzzleHttpClient();
    }

    /**
     * @throws GuzzleException
     */
    public function post(string $url, array $data = [], array $headers = []): array
    {
        return $this->request('POST', $url, [
            'json' => $data,
            'headers' => $headers,
        ]);
    }

    /**
     * @throws GuzzleException
     */
    public function get(string $url, array $query = [], array $headers = []): array
    {
        return $this->request('GET', $url, [
            'query' => $query,
            'headers' => $headers,
        ]);
    }

    /**
     * @throws GuzzleException
     */
    protected function request(string $method, string $url, array $options): array
    {
        $response = $this->client->request($method, $url, $options);
        $jsonResponse = $response->getBody()->getContents();
        return json_decode($jsonResponse, true);
    }
}
