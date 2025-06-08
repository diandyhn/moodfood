<?php

namespace App\Strategies;

use Illuminate\Database\Eloquent\Collection;

interface RecommendationStrategyInterface
{
    public function recommend(string $mood, array $preferences = []): Collection;
}
