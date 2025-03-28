<?php

namespace App\Modules\Api\Apptika\Response;

class ApptikaResponse
{
    public function __construct(protected readonly array $response)
    {
    }

    public function isOk(): bool
    {
        return $this->getMessage() === 'ok' && $this->getStatusCode() === 200;
    }

    public function getMessage(): ?string
    {
        return $this->response['message'] ?? null;
    }

    public function getStatusCode(): int
    {
        return $this->response['status_code'] ?? 500;
    }

    public function getData(): array
    {
        return $this->response['data'] ?? [];
    }

    public function getError(): ?string
    {
        return $this->response['error'] ?? null;
    }
}
