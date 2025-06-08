<?php

namespace App\Factories;

use App\Strategies\{
    RecommendationStrategyInterface,
    MoodBasedStrategy,
    HealthBasedStrategy,
    BudgetBasedStrategy
};

class RecommendationStrategyFactory
{
    public static function create(string $type): RecommendationStrategyInterface
    {
        return match($type) {
            'mood' => new MoodBasedStrategy(),
            'health' => new HealthBasedStrategy(),
            'budget' => new BudgetBasedStrategy(),
            default => new MoodBasedStrategy(),
        };
    }
}
