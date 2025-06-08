<?php

namespace App\Factories;

use App\Strategies\MoodBasedStrategy;
use App\Strategies\HealthBasedStrategy;
use App\Strategies\BudgetBasedStrategy;

class RecommendationStrategyFactory
{
    public static function create(string $type)
    {
        switch ($type) {
            case 'mood':
                return new MoodBasedStrategy();

            case 'health':
                return new HealthBasedStrategy();

            case 'budget':
                return new BudgetBasedStrategy();

            default:
                throw new \InvalidArgumentException("Strategy type '$type' tidak dikenal.");
        }
    }
}
