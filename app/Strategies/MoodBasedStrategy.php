<?php

namespace App\Strategies;

use App\Models\FoodItem;
use Illuminate\Database\Eloquent\Collection;

class MoodBasedStrategy implements RecommendationStrategyInterface
{
    public function recommend(string $mood, array $preferences = []): Collection
    {
        return FoodItem::whereJsonContains('mood_tags', $mood)
            ->limit(10)
            ->get();
    }
}
