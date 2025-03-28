<?php

namespace App\Repositories;

use App\Models\TopAppHistory;

class TopAppHistoryRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(TopAppHistory::class);
    }
}
