<?php

namespace App\Decorators;

use Illuminate\Database\Eloquent\Collection;

class BaseRecommendation implements RecommendationInterface
{
    protected Collection $recommendations;
    protected array $metadata;

    public function __construct(Collection $recommendations)
    {
        $this->recommendations = $recommendations;
        $this->metadata = [];
    }

    public function getRecommendations(): Collection
    {
        return $this->recommendations;
    }

    public function getMetadata(): array
    {
        return $this->metadata;
    }
}
