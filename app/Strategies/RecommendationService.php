<?php

namespace App\Services;

use App\Strategies\RecommendationStrategyInterface;
use Illuminate\Database\Eloquent\Collection;

class RecommendationService
{
    private RecommendationStrategyInterface $strategy;

    public function __construct(RecommendationStrategyInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    public function setStrategy(RecommendationStrategyInterface $strategy): void
    {
        $this->strategy = $strategy;
    }

    public function getRecommendations(string $mood, array $preferences = []): Collection
    {
        return $this->strategy->recommend($mood, $preferences);
    }
}
