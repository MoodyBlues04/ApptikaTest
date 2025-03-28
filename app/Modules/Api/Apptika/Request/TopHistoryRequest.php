<?php

namespace App\Modules\Api\Apptika\Request;

use App\Modules\Api\ApiRequest;

class TopHistoryRequest implements ApiRequest
{
    public const AMONG_US_APP = 1421444;
    public const USA_COUNTRY = 1;

    public function __construct(
        public readonly int $applicationId,
        public readonly int $countryId,
        public readonly string $dateFrom,
        public readonly string $dateTo,
    ) {
    }

    public static function defaultRequest(string $dateFrom, string $dateTo): self
    {
        return new self(self::AMONG_US_APP, self::USA_COUNTRY, $dateFrom, $dateTo);
    }

    public function getRequest(): array
    {
        return [
            'date_from' => $this->dateFrom,
            'date_to' => $this->dateTo,
        ];
    }
}
