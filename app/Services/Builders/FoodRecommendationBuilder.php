<?php

namespace App\Services\Builders;

use App\Models\Food;
use Illuminate\Database\Eloquent\Builder;

class FoodRecommendationBuilder
{
    protected Builder $query;

    public function __construct()
    {
        $this->query = Food::query();
    }

    public function forMood(string $mood): self
    {
        $this->query->where('mood', $mood);
        return $this;
    }

    public function forTimeOfDay(string $time): self
    {
        $this->query->where('time_of_day', $time);
        return $this;
    }

    public function forDiet(string $diet): self
    {
        $this->query->where('diet', $diet);
        return $this;
    }

    public function get()
    {
        return $this->query->get();
    }
}
