<?php

namespace App\Repositories;

use App\Models\TopAppHistory;
use Illuminate\Support\Facades\DB;

class TopAppHistoryRepository extends Repository
{
    public function __construct()
    {
        parent::__construct(TopAppHistory::class);
    }

    public function getBestCategoryPositionsByDate(string $date): array
    {
        return $this->query->select('category_id', DB::raw('MIN(position) as min_position'))
            ->where('date', $date)
            ->groupBy('category_id')
            ->pluck('min_position', 'category_id')
            ->all();
    }
}
