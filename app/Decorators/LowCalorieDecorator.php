<?php

namespace App\Decorators;

use Illuminate\Database\Eloquent\Collection;

class LowCalorieDecorator extends RecommendationDecorator
{
    private int $calorieThreshold;

    public function __construct(RecommendationInterface $recommendation, int $calorieThreshold = 300)
    {
        parent::__construct($recommendation);
        $this->calorieThreshold = $calorieThreshold;
    }

    public function getRecommendations(): Collection
    {
        $recommendations = parent::getRecommendations();

        $recommendations->each(function ($item) {
            if ($item->calories <= $this->calorieThreshold) {
                $item->setAttribute('is_low_calorie', true);
                $item->setAttribute('calorie_tag', 'Low-Calorie');
                $item->setAttribute('health_badge', 'Pilihan Sehat');
            }
        });

        return $recommendations;
    }

    public function getMetadata(): array
    {
        $metadata = parent::getMetadata();
        $lowCalorieCount = $this->getRecommendations()
            ->where('calories', '<=', $this->calorieThreshold)
            ->count();

        $metadata['low_calorie_count'] = $lowCalorieCount;
        $metadata['calorie_threshold'] = $this->calorieThreshold;

        return $metadata;
    }
}
