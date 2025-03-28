<?php

namespace App\Modules\Api;

interface ApiRequest
{
    public function getRequest(): array;
}
