<?php

namespace App\Strategies;

use App\Models\FoodItem;
use Illuminate\Database\Eloquent\Collection;

class BudgetBasedStrategy implements RecommendationStrategyInterface
{
    public function recommend(string $mood, array $preferences = []): Collection
    {
        $maxPrice = $preferences['max_price'] ?? 50000;
        
        return FoodItem::where('price', '<=', $maxPrice)
            ->whereJsonContains('mood_tags', $mood)
            ->orderBy('price', 'asc')
            ->limit(10)
            ->get();
    }
}
