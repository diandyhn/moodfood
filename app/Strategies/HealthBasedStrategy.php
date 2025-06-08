<?php

namespace App\Strategies;

use App\Models\FoodItem;
use Illuminate\Database\Eloquent\Collection;

class HealthBasedStrategy implements RecommendationStrategyInterface
{
    public function recommend(string $mood, array $preferences = []): Collection
    {
        $calorieLimit = $preferences['calorie_limit'] ?? 500;
        
        return FoodItem::where('is_healthy', true)
            ->where('calories', '<=', $calorieLimit)
            ->whereJsonContains('mood_tags', $mood)
            ->orderBy('calories', 'asc')
            ->limit(10)
            ->get();
    }
}
